<?php

class Template
{
    public function showTop()
    {
        if(!isset($_SESSION['loggedIn'])):
        ?>
            <div id="top">
                <h3 class="large floatLeft" style="color:red">My Browser Game</h3>
                <div class="accountOptions floatRight">
                    <a href="?page=register"><button>Register</button></a><br>
                    <a href="?page=login"><button>Login</button></a>
                </div>
            </div>
        <?php
        else:
        ?>
            <div id="top">
                <h3 class="large floatLeft" style="color:red">My Browser Game</h3>
                <div class="accountOptions floatRight">
                    <a href="?page=logout"><button>Logout</button></a>
                </div>
            </div>
        <?php
        endif;
    }
    public function showFooter()
    {
        ?>
            <div id="footer">
                <p style="margin:0">Made by Scutaru Florin</p>
            </div>
        <?php
    }
}
?>