<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->


        <div class="user-box">
            @if($currentUser)
                <div class="user-img">
                    <?php $avatar = !empty($currentUser->image) ? $currentUser->image : asset('admin/assets/images/users/user.png') ?>
                    <img src="{{ $avatar  }}" alt="user-img"
                         class="rounded-circle img-thumbnail img-responsive">


                    <div class="user-status online"><i class="mdi mdi-adjust"></i></div>
                </div>
                <h5><a href="#">{{$currentUser->name.' '.$currentUser->lastname}}</a></h5>
            @endif

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('swith_theme')}}" class="text-custom">
                        <i class="ti  dripicons-lightbulb sidebar_bulb"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ route('settings')}}">
                        <i class="mdi mdi-settings"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ route('logout')}}" class="text-custom text-danger">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>

            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navigation</li>

                <li>
                    <router-link tag="a" :to="{ name: 'DashboardComponent' }" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </router-link>
                </li>

                <li>
                    <router-link tag="a" :to="{ name: 'ListPosts'}" class="waves-effect">
                        <i class="ti  ti-pin-alt"></i> <span> Posts </span>
                    </router-link>
                </li>

                <li>
                    <router-link tag="a" :to="{ name: 'ListUsers'}" class="waves-effect">
                        <i class="ti   ti-user"></i> <span> Users </span>
                    </router-link>
                </li>


                {{--      <li>
                          <a href="" class="waves-effect"><i class="ti ti-bookmark"></i>
                              <span> Categories </span>
                          </a>
                      </li>

                      <li>
                          <a href="" class="waves-effect"><i class="ti  ti-tag"></i>
                              <span> Pages </span>
                          </a>
                      </li>
                      <li>
                          <a href="" class="waves-effect"><i class="ti   ti-user"></i>
                              <span> Users </span>
                          </a>
                      </li>--}}

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>