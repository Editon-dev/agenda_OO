        <div class="menu-bar" id="paineladm">
            <div class="bar-itens">
                <div class="logo" onclick="document.location.href='http://18.118.136.86/agenda/index.php'"></div>
                <div class="titulo">
                    AGENDA DE AUTORIDADES
                </div>
                <div class="adm-button" id="<?php echo $hidden ?>">
                    <button class="menu-button" id="adm"  onclick="document.location.href='<?php echo $admurl ?>'"><img class="adm-icon" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/agenda/images/<?php echo $admimg ?>"><?php echo $admname ?></button>
                </div>
            </div>
        </div>