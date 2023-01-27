<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="/">
                    <img
                        src="/assets/images/logo.jpg"
                        alt=""
                        width="100"
                        height="50"
                        class="d-inline-block align-text-top"
                    />
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a
                                class="nav-link fs-4 text-black"
                                aria-current="page"
                                href="/"
                                >Início</a
                            >
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/users">Usuários</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link fs-4 text-black" href="/logout">Sair</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>
    export default {
        name: 'navbar',
    };
</script>
