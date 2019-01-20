<?php
    class Town
    {
        public $db;

        public function __construct($db)
        {
            $this->db=$db;
        }

        public function GetResources()
        {
            $sql="SELECT res.wood,res.stone,res.iron,res.gold,w.buildings FROM resources AS res 
                RIGHT JOIN users AS us ON res.id=us.id
                INNER JOIN world AS w ON w.id=us.id
                WHERE us.username='".$_SESSION['loggedIn']."'"; 
                $stmt=$this->db->query($sql);
                $res=$stmt->fetchAll();
        ?>
        <fieldset>
            <legend style="text-align:center">
                Resources
            </legend>
            <span style="width: 25%;float: left;text-align: center;">Wood: <?php echo $res[0]['wood'];?></span>
            <span style="width: 25%;float: left;text-align: center;">Stone: <?php echo $res[0]['stone'];?></span>
            <span style="width: 25%;float: left;text-align: center;">Iron <?php echo $res[0]['iron'];?></span>
            <span style="width: 25%;float: left;text-align: center;">Gold: <?php echo $res[0]['gold'];?></span>
        </fieldset>
        <?php
        }

        public function DrawTownBuidings()
        {
            $query="SELECT * FROM world INNER JOIN users ON users.id=world.id WHERE users.username='".$_SESSION['loggedIn']."'";
            
            $statement=$this->db->query($query);

            $res=$statement->fetchAll();

            $ourBuildings=explode(";",$res[0]['buildings']);
            
            $x=0;
            
            echo "<div id='boxHolder'>";
            $x=0;
                for ($i=0; $i < 3; $i++) { 
                    for ($j=0; $j < 3; $j++) {
                        if($ourBuildings[$x]==0){
                            $text='Nothing';
                        }else{
                            $id=$ourBuildings[i];
                            $sql="SELECT * FROM buildings WHERE id=".$id;
                            $stmt=$this->db->query($sql);
                            $building=$stmt->fetchAll();
                            $text=$building[0]['name'];
                        }
                        echo "<span id='".$x."' class='gridBox'>".$text."</span>";
                        $x++;
                    }
                }
                

            echo "</div>";
            $bq="SELECT * FROM buildings";
            $stmt_buildings=$this->db->query($bq);
            $allBuildings=$stmt_buildings->fetchAll(PDO::FETCH_GROUP);
            echo "<div class='buildingOptions'>";
                echo "<span id='buildLocation' style='display:none'></span>";
                foreach($allBuildings as $key=>$building){
                    echo "<div id='".$key."' class='buidingBox'>".$building[0]['name']."<br>
                    W: ".$building[0]['wood_cost']."<br>
                    S: ".$building[0]['stone_cost']."<br>
                    I: ".$building[0]['iron_cost']."<br>
                    G: ".$building[0]['gold_cost']."<br>
                    </div>";
                }
            echo "</div>";
            ?>
            <script>
                $(".gridBox").hover(function(){
                    $(this).css('background','#000fff');
                },function(){
                    $(this).css('background','inherit');
                });

                $('.gridBox').on('click',function(event){

                        var id=$(this).attr('id');
                        $('#buildLocation').text(id);
                        $('.buildingOptions').css('left',event.pageX);
                        $('.buildingOptions').css('top',event.pageY);
                        $('.buildingOptions').fadeToggle();
                    
                });
                //buildingBox design
                $('.buidingBox').css('background','white');
                $('.buidingBox').css('float','left');
                $('.buidingBox').css('width','30%');
                $('.buidingBox').css('height','100px');
                $('.buidingBox').css('border','1px solid black');
                $('.buidingBox').css('margin','2px');
                //$('.buidingBox').css('line-height','50px');
                $('.buidingBox').css('text-align','center');
                //when building is clicked it should be bought
                $('.buidingBox').click(function(){
                    var id=$(this).attr('id');
                    var locID=$('#buildLocation').text();
                    $.post('?page=buyBuilding',{
                        location: locID,
                        building: id,
                    }).done(function(){
                        $('#main').load('?page=loggedIn&nonUI')
                    });
                });
            </script>
            <?php
        }

        public function CreateBuiding($location,$buildingID)
        {
            $sql="SELECT * FROM buildings WHERE id=?";
            $stmt=$this->db->prepare($sql);
            $stmt->execute(array($buildingID));
            if ($stmt->rowCount()>0) {
                $buildingResult=$stmt->fetch();
                $sql="SELECT * FROM resources 
                RIGHT JOIN users ON users.id=resources.id 
                INNER JOIN world ON world.id=resources.id 
                WHERE users.username='".$_SESSION['loggedIn']."'";
                $stmt=$this->db->query($sql);
                $result=$stmt->fetchAll();
                
                //our currency
                $currencyArray=array("wood_cost"=>$result[0]['wood'],"stone_cost"=>$result[0]['stone'],"iron_cost"=>$result[0]['iron'],"gold_cost"=>$result[0]['gold']);
                $newCurrency=array();
                $couldNotAfford=0;

                foreach ($currencyArray as $currency => $amount) {
                    //echo $buildingResult[$currency]." my ".$currency." ".$amount."<br>";
                    if($buildingResult[$currency]>$amount){
                        $couldNotAfford=1;
                        break;
                    }else {
                        $newCurrency+=array($currency=>$amount-$buildingResult[$currency]);
                    }
                }
                    
                    if ($couldNotAfford===0) {
                        // you can afford it
                        $ourTown=explode(';',$result['buildings']);
                        if ($ourTown[$location]===0) {
                            // the spot is empty
                            $ourTown[$location]=$buildingID;
                            $ourTown=implode(';',$ourTown);
                            // Update the buidings column of world table
                            $sql="UPDATE world SET buildings='".$ourTown."' WHERE id=".$result['id'];
                            $this->db->query($sql);
                            // Update resources
                            $sql1="UPDATE resources SET wood=".$newCurrency['wood_cost']."
                            ,stone=".$newCurrency['stone_cost']."
                            ,iron=".$newCurrency['stone_cost'].",
                            gold=".$newCurrency['stone_cost']." 
                            WHERE id=".$result['id'];
                            $this->db->query($sql1);
                        }else {
                            //another building in the spot
                            echo "Another building is already in this spot!";
                        }

                    } else {
                        echo "You cannot afford this building!";
                    }

            }else{
                echo "Building does not exist!";
            }
        }
    }
    
?>