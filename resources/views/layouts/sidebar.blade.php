<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Children Records
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('cr.index') }}" class="nav-link">
                        <i class="far fa-file nav-icon"></i>
                        <p>Records</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cr.create') }}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>Add Record</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('food.foods') }}" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Foods</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('distribute.index') }}" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Food Distributions</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('vitamin.index') }}" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Vitamins</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('distributevit.index') }}" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Vitamin Distributions</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('purok.index') }}" class="nav-link">
                <i class="far fa-file nav-icon"></i>
                <p>Puroks</p>
            </a>
        </li>


        <li class="nav-header text-uppercase">Child Growth Standards</li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Weight for Age
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('wfa.boys') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Boys</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wfa.girls') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Girls</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Height for Age
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('hfa.boys') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Boys</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('hfa.girls') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Girls</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Weight for Height
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('wfh.boys') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Boys</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wfh.girls') }}" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>Girls</p>
                    </a>
                </li>
            </ul>
        </li>



        <li class="nav-header text-uppercase">Settings</li>

        <li class="nav-item @if (Auth::user()->role !== 'admin') d-none @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i>
                        <p>Add User</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="nav-link bg-danger"
                    onclick="event.preventDefault();
                this.closest('form').submit();">
                    <i class="fa fa-power-off"></i>
                    <p>Logout</p>
                </a>

            </form>
        </li>
    </ul>
</nav>
