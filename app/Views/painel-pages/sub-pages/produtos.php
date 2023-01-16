<div class="contents">
    <h3>
        <div class="breadcrumbs">
            <a class="link path-1" href="<?= PATH_URL?>painel/gerenciar">
                <svg width="8" height="16" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.99984 16.9201L1.47984 10.4001C0.709844 9.63008 0.709844 8.37008 1.47984 7.60008L7.99984 1.08008" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Voltar</span>
            </a>
        </div>
    </h3>
</div>

<div class="produtos">
    <div class="produtos--wraper">

        <?php
            foreach ($dados as $key => $value):
            $img = $value['images'][0]['nome'];
        ?>

            <div class="card">

                <div style="background-image: url('../../assets/upload/<?= $img?>');" 
                class="card--img <?= intval($value['disponivel']) === 0 ? 'hide': ''; ?>"></div>

                <div class="card--edit_btn">
                    <!--icone-->
                    <a id="editarProduto" href="<?= PATH_URL.'painel/gerenciar/produto/?code='.$value['id_code']?>">
                        <svg width="18" height="18" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.54996 2.08806L2.70829 8.6584C2.44996 8.90791 2.19996 9.39936 2.14996 9.7396L1.84162 12.1893C1.73329 13.0739 2.43329 13.6788 3.39996 13.5276L6.08329 13.1117C6.45829 13.0512 6.98329 12.8017 7.24162 12.5447L14.0833 5.97432C15.2666 4.8402 15.8 3.5473 13.9583 1.96709C12.125 0.402004 10.7333 0.953942 9.54996 2.08806V2.08806Z" stroke="#505050" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.40833 3.18457C8.58304 4.19836 9.12384 5.13082 9.94584 5.83557C10.7679 6.54033 11.8245 6.97747 12.95 7.07838M1 16.0001H16" stroke="#505050" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div><!--card--edit_btn-->

                <div class="card--informativo <?= intval($value['disponivel']) === 0 ? 'hide' : 'show'; ?>">
                    <h3><?= $value['nome']?></h3>
                    <div class="card--estoque_produto">
                        <p>Estoque</p>
                        <p><?= $value['quantidade']?></p>
                    </div>
                </div><!--card--informativo-->

                <?php
                    if (!intval($value['disponivel'])):
                ?>
                    <div class="card--aviso">
                        
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 21H21M11 1V2M3 3L4 4M19 3L18 4M11 5C8.61305 5 6.32387 5.94821 4.63604 7.63604C2.94821 9.32387 2 11.6131 2 14V21H20V14C20 11.6131 19.0518 9.32387 17.364 7.63604C15.6761 5.94821 13.3869 5 11 5V5Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        <p>SEM ESTOQUE</p>
                    </div>
                <?php endif;?>      
            </div><!--card-->

        <?php endforeach;?>
    </div><!--produtos--wraper-->
</div><!--produtos-->