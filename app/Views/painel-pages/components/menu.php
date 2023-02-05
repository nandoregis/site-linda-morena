<sidebar class="menu">   
    <div class="menu--perfil">
        <div class="menu--perfil_usuario">

            <div class="icon_svg">
                <svg width="50" height="50" viewBox="0 0 103 102" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M101.41 101C101.41 81.65 79.0001 66 51.4099 66C23.8197 66 1.40991 81.65 1.40991 101M51.4099 51C59.1287 51 66.5313 48.3661 71.9893 43.6777C77.4473 38.9893 80.5135 32.6304 80.5135 26C80.5135 19.3696 77.4473 13.0107 71.9893 8.32233C66.5313 3.63392 59.1287 1 51.4099 1C43.6912 1 36.2885 3.63392 30.8306 8.32233C25.3726 13.0107 22.3063 19.3696 22.3063 26C22.3063 32.6304 25.3726 38.9893 30.8306 43.6777C36.2885 48.3661 43.6912 51 51.4099 51V51Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <h3><?= @$_SESSION['NOME_ADMIN']?></h3>

        </div>
    </div>

    <div class="menu--navegacao">
        <header class="menu--navegacao_header">
            <nav>
                <ul>
                    <?php
                        $urlPage = explode('/',$_GET['url'])[1];  
                    ?>
                    
                    <li class="menu--pagina <?= $urlPage === 'inicio' ? 'selected': ''?>">
                        <a href="<?= PATH_URL?>painel/inicio">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4263 16.8163V13.8163M9.5031 1.63626L2.59754 7.18626C1.82029 7.80626 1.32205 9.11626 1.49145 10.0963L2.81676 18.0563C3.05592 19.4763 4.41112 20.6263 5.84604 20.6263H17.0066C18.4315 20.6263 19.7967 19.4663 20.0358 18.0563L21.3611 10.0963C21.5206 9.11626 21.0223 7.80626 20.2551 7.18626L13.3495 1.64626C12.2833 0.786255 10.5594 0.786255 9.5031 1.63626V1.63626Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span> Inicio </span>
                        </a>
                    </li>
    
                    <li class="menu--pagina <?= $urlPage === 'cadastro' ? 'selected': ''?>">
                        <a href="<?= PATH_URL?>painel/cadastro">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4263 16.8163V13.8163M9.5031 1.63626L2.59754 7.18626C1.82029 7.80626 1.32205 9.11626 1.49145 10.0963L2.81676 18.0563C3.05592 19.4763 4.41112 20.6263 5.84604 20.6263H17.0066C18.4315 20.6263 19.7967 19.4663 20.0358 18.0563L21.3611 10.0963C21.5206 9.11626 21.0223 7.80626 20.2551 7.18626L13.3495 1.64626C12.2833 0.786255 10.5594 0.786255 9.5031 1.63626V1.63626Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span> Cadastro </span>
                        </a>
                    </li>
    
                    <li class="menu--pagina <?= $urlPage === 'gerenciar' ? 'selected': ''?>">
                        <a href="<?= PATH_URL?>painel/gerenciar">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4263 16.8163V13.8163M9.5031 1.63626L2.59754 7.18626C1.82029 7.80626 1.32205 9.11626 1.49145 10.0963L2.81676 18.0563C3.05592 19.4763 4.41112 20.6263 5.84604 20.6263H17.0066C18.4315 20.6263 19.7967 19.4663 20.0358 18.0563L21.3611 10.0963C21.5206 9.11626 21.0223 7.80626 20.2551 7.18626L13.3495 1.64626C12.2833 0.786255 10.5594 0.786255 9.5031 1.63626V1.63626Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span> Gerenciar </span>
                        </a>
                    </li>
    
                </ul>
            </nav>
        </header>
    </div>
    
    <div class="menu--final"></div>
</sidebar>