<div style="position: fixed; z-index: 1; width: 100%">
    <div class="header-area" id="tampilan-header">
        <div class="row align-items-center">
            <!-- nav and search button -->
            <div class="col-md-6 col-sm-8 clearfix">
                <div class="nav-btn pull-left">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <!-- profile info & task notification -->
            <div class="col-sm-3 clearfix">
                <ul class="notification-area pull-right">   
                    <li><button class="btn btn-outline btn-primary" onclick="back()"><i class="ti-arrow-left"></i> Back</button></li>                         
                    <li id="full-view"><i class="ti-fullscreen"></i></li>
                    <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                    <li class="user-name dropdown-toggle" data-toggle="dropdown"><i class="ti-settings"></i>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><div class="icon-container"><span class="icon-name">Account Setting</span></div></a>
                            <a class="dropdown-item" href="#"><div class="icon-container"><span class="icon-name">Log Out</span></div></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div style="visibility: hidden; z-index: 0" id="belakang"></div>

<script type="text/javascript">$("#tampilan-header").clone().prependTo("#belakang");</script>