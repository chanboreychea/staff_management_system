<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="box-nav-tabs nav-tavs-profile mb-5">
        <ul class="nav" role="tablist">
            <li><a class="btn btn-border mb-20 active" href="">Dashboard</a>
            </li>
            <li><a class="btn btn-border mb-20" href="">Jobs</a>
            </li>
            <li><a class="btn btn-border mb-20" href="">Orders</a></li>
            <li><a class="btn btn-border mb-20" href="">My Profile</a></li>
            <li>
                 <!-- Authentication -->
                 <form method="POST">
                    @csrf
                <a class="btn btn-border mb-20" href="{{url('')}}" >Logout</a>

                </form>
            </li>
        </ul>

    </div>
</div>
