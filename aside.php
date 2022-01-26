<aside>
    <div class="infos">
        <img src="./imgs/user-img.png" alt="user img" />
        <p><?= $emp['nom']; ?></p>
    </div>
    <div class="menu">
        <a href="./index.php"><i class="fas fa-home"></i>
            <p>Accueil</p>
        </a>
        <a href="./ajouter.php"><i class="fas fa-plus-circle"></i>
            <p>Ajouter produit</p>
        </a>
        <a id="achat" href="#"><i class="fas fa-file-invoice-dollar"></i>
            <p>Effecuter achat</p>
        </a>
        <a href="./process.php?decon"><i class="fas fa-sign-out-alt"></i>
            <p>Se déconnecter</p>
        </a>
    </div>
</aside>