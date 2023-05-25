<div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
    <aside class="sidebar">
        <a href="#" class="sidebar-logo">
            <div class="d-flex justify-content-start align-items-center">
                <span>Riseup</span>
            </div>

            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="./assets/img/global/navbar-times.svg" alt="" />
            </button>
        </a>

        <h5 class="sidebar-title">UKM Management</h5>

        <a href="{{ route('categories.index') }}"
            class="sidebar-item{{ Request::segment(1) == 'categories' ? ' active' : '' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span class="text-black">Category</span>
        </a>

        <a href="{{ route('ukms.index') }}"
            class="sidebar-item{{ Request::segment(1) == 'ukms' ? ' active' : '' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span class="text-black">UKM</span>
        </a>

                <h5 class="sidebar-title">UKM Management</h5>

        <a href="{{ route('funding.index') }}"
            class="sidebar-item{{ Request::segment(1) == 'funding' ? ' active' : '' }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span class="text-black">Funding</span>
        </a>

    </aside>
</div>
