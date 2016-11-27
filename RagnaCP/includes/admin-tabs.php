<nav class="tab-nav">
    <a href="#tab-1" class="tab-item active" >ACC ID</a>
    <a href="#tab-2" class="tab-item" >Email</a>
    <a href="#tab-3" class="tab-item ip-tab" >IP</a>
    <a href="#tab-4" class="tab-item" >Char</a>
    <a href="#tab-5" class="tab-item edit-tab" >Editar Conta</a>
    <a href="#tab-6" class="tab-item char-info-tab" >Char Info</a>
    <a href="#tab-7" class="tab-item acc-ban" >Ban</a>
</nav>

<div class="tab-content">
    <div id="tab-1">
        <h3> Insira o ID a ser Pesquisado</h3>
        <hr>
        <?php include"admin_accid_search.php";?>
    </div>
    <div id="tab-2" class="hide">
        <h3> Insira o Email a ser Encontrado</h3>
        <hr>
        <?php include"admin-email-search.php";?>  
    </div>
    <div id="tab-3" class="hide">
        <h3> Insira IP a ser Encontrado</h3>
        <hr>
        <?php include"admin-ip-search.php";?>  
    </div>
    <div id="tab-4" class="hide">
        <h3> Insira o nome do Char Encontrado</h3>
        <hr>
        <?php include"admin-char-search.php";?>  
    </div>
    <div id="tab-5" class="hide">
        <h3> Editar Conta</h3>
        <hr>
        <?php include"edit-char-admin.php";?>  
    </div>
    <div id="tab-6" class="hide">
        <h3> Informações do Personagem</h3>
        <hr>
        <?php include"list-char-admin.php";?>  
    </div>
    <div id="tab-7" class="hide">
        <h3> Banir / Desbanir conta</h3>
        <hr>
        <?php include"ban-char-admin.php";?>  
    </div>
</div>
