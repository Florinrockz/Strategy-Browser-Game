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
                LEFT JOIN users AS us ON res.id=us.id
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
        }
    }
    
?>