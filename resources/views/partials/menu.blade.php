<div class="sidebar" style="width: 400px;">
    <nav class="sidebar-nav" style="width: 400px;">

        <ul class="nav" style="width: 400px;">
            @foreach($categories as $name => $subCategory)
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#" style="margin-right: 20px;">
                    <i class="fa-fw fas fa-users nav-icon"></i>
                    {{ $name }}
                </a>
                <ul class="nav-dropdown-items">
                    @foreach($subCategory as $categoryName => $products)
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#" style="padding-left: 50px; margin-right: 20px;">
                            <i class="fa-fw fas fa-user nav-icon"></i>
                            {{ $categoryName }}
                        </a>
                        <ul class="nav-dropdown-items">
                            @foreach($products as $id => $productName)
                            <li class="nav-item" style="padding-left: 100px;">
                                <a href="{{ route("product.index", $id) }}" class="nav-link">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon"></i>
                                    {{ $productName }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>

    </nav>
</div>