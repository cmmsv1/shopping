<div class="wrap-search center-section">
    <div class="wrap-search-form">
        <form id="form-search-top" action="{{ route('search') }}" name="form-search-top">
            <input type="text" name="search" id="search_top" placeholder="Search here..." autocomplete="off">
            <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <div class="search_bar">
            <div class="body">
                <span class="title">Danh mục sản phẩm</span>
                <div class="body_name">
                    <ul>
                        @foreach ($categories as $category)
                            <li><a
                                    href="{{ route('search.parentcategories', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .search_bar {
        position: absolute;
        top: 40px;
        right: 55px;
        left: 0px;
        background-color: #fff;
        z-index: 10;
        text-align: left;
        padding: 10px 10px 0px 10px;
        display: none;
    }

    .search_bar .title {
        color: rgb(59, 59, 59);
        font-weight: 700;
    }

    .search_bar .body_name ul {
        padding: 0;
        margin-top: 10px;
    }

    .search_bar .body_name ul li {
        list-style: none;
        margin: 0;
        display: inline-block;
        padding: 5px 15px;
        border: 1px solid #bbb;
        margin-bottom: 10px;
        margin-right: 7px;
        border-radius: 5px;
        background-color: rgba(223, 217, 217, 0.2);
    }

    .search_bar .body_name ul li:hover {
        background-color: #ff2832;
    }

    .search_bar .body_name ul li:hover a {
        color: #fff;
    }

    .search_bar .body_name ul li a {
        color: rgb(90, 88, 88);
    }

</style>
<script>
    $(document).ready(function() {
        $('#search_top').focus(function() {
            $('.search_bar').fadeIn(500);
        }).focusout(function() {
            $('.search_bar').fadeOut(500);
        });
    });
</script>
