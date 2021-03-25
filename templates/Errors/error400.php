<!-- Error 404 Area Start -->
<div class="error404-area ptb-45">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-wrapper text-center">
                    <div class="error-text">
                        <h1>404</h1>
                        <h2>Oops! PAGE NOT FOUND</h2>
                        <p>Sorry but the page you are looking for does not exist, or has been removed, or has its name changed or is temporarily unavailable.</p>
                    </div>
                    <div class="search-error">
                        <form id="search-form" action="#">
                            <input type="text" placeholder="Search">
                            <button>
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="error-button">
                        <a href="<?=$this->Url->build('/', ['fullBase' => true]);?>">Back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->
