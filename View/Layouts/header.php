<body>
    <header>
        <div class="container">
            
            <div class="tituloHeader">
                <h1>Corridas</h1>
            </div>
            <nav>
                <ul>
                    <li class="liCadastro"><a href="cadastro">Cadastro</a></li>
                    <li class="liConsulta"><a href="consulta">Consulta</a></li>
                    <li class="liSair"><a href="fazerlogout">Sair</a></li>
                </ul>
            </nav>
            <div class="menuResponsive deixarInvisivel">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1200px-Hamburger_icon.svg.png">
            </div>
            
        </div>
    </header>
    <div class="menuResponsiveOpcoes deixarInvisivel">
        <a href="cadastro">Cadastro</a>
        <a href="consulta">Consulta</a>
        <a href="fazerlogout">Sair</a>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on ("click", ".menuResponsive", function () {
                $('.menuResponsiveOpcoes').toggleClass('deixarInvisivel');
            })
            $( window ).resize(function() {
              $('.menuResponsiveOpcoes').addClass('deixarInvisivel');
            });
        })
    </script>