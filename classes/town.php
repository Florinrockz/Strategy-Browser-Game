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
                        echo "<span class='gridBox'>".$text."</span>";
                        $x++;
                    }
                }
                

            echo "</div>";
            $bq="SELECT * FROM buildings";
            $stmt_buildings=$this->db->query($bq);
            $allBuildings=$stmt_buildings->fetchAll(PDO::FETCH_GROUP);
            echo "<div class='buildingOptions'>";
                for($x=1;$x<count($allBuildings)+1;$x++){
                    echo "<div class='buidingBox'>".$allBuildings[$x][0]['name']."</div>";
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
                    $('.buildingOptions').css('left',event.pageX);
                    $('.buildingOptions').css('top',event.pageY);
                    $('.buildingOptions').css('display','inline');
                });
                //buildingBox design
                $('.buidingBox').css('background','white');
                $('.buidingBox').css('float','left');
                $('.buidingBox').css('width','30%');
                $('.buidingBox').css('height','50px');
                $('.buidingBox').css('border','1px solid black');
                $('.buidingBox').css('margin','2px');
                $('.buidingBox').css('line-height','50px');
                $('.buidingBox').css('text-align','center');
                //when building is clicked it should be bought
                $('.buidingBox').click(function(){
                    
                });
            </script>
            <?php
        }
    }
    
?>