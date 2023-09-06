<div id="particles-js"></div>
<div>
    <nav>
        <div class="logo">
            <i class='bx bx-menu menu-icon'></i>
            <span class="logo-name">
                {{ $user->nom }}
            </span>
        </div>

        <div class="sidebar">
            <div class="logo">
                <i class='bx bx-menu menu-icon'></i>
                <span class="logo-name">
                    {{ $user->nom }}
                </span>
            </div>
            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a href="/PageAjoutTache" class="nav-link">
                            <i class='bx bx-add-to-queue icon'></i>
                            <span class="link">{{ trans('navbar.add') }}</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="/Tache" class="nav-link">
                            <i class='bx bx-list-ul icon'></i>
                            <span class="link">{{ trans('navbar.list') }}</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="/TacheToday" class="nav-link">
                            <i class='bx bx-task icon'></i>
                            <span class="link">{{ trans('navbar.today') }}</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="/Corbeille" class="nav-link">
                            <i class='bx bx-trash icon'></i>
                            <span class="link">{{ trans('navbar.recycle') }}</span>
                        </a>
                    </li>
                </ul>
                <div class="bottom-content">
                    <li class="list">
                        <a href="/Parametre" class="nav-link">
                            <i class='bx bxs-user-detail icon'></i>
                            <span class="link">{{ trans('navbar.settings') }}</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="/logout" class="nav-link">
                            <i class='bx bx-log-out icon'></i>
                            <span class="link">{{ trans('navbar.logout') }}</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <section class="overlay"></section>
</div>

<script>
    const  navBar = document.querySelector("nav"), menuBtn = document.querySelectorAll(".menu-icon"), overlay = document.querySelector(".overlay");
    menuBtn.forEach(menuBtn => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    })
</script>