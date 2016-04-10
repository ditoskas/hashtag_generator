<nav class="navbar navbar-default" id="main-menu">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-content" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Hashtag Generator</a>
        </div>

        <div class="collapse navbar-collapse" id="main-menu-content">
            <ul class="nav navbar-nav">
                <li class="<?= ($this->request->action=='home')?'active':'' ?>"><a href="/">Home</a></li>
                <li  class="<?= ($this->request->action=='testCoverage')?'active':'' ?>"><a href="/pages/test_coverage" >Test Coverage</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav> <!-- / nav.navbar navbar-default -->