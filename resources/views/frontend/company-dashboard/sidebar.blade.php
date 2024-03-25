<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="box-nav-tabs nav-tavs-profile mb-5">
        <ul class="nav" role="tablist">
            <li><a class="btn btn-border mb-20 active" href="">Dashboard</a>
            </li>
            <li><a class="btn btn-border mb-20 fontKef2" href="/user/profile">ព័ត៍មានផ្ទាល់ខ្លួន</a></li>
            <li><a class="btn btn-border mb-20 fontKef2" href="">ព័ត៍មានអំពីស្ថានភាព</a>
            </li>
            {{-- <li><a class="btn btn-border mb-20" href="">Orders</a></li>
            <li> --}}
                 <!-- Authentication -->
                 <form method="POST">
                    @csrf
                <a class="btn btn-border mb-20" href="/logout" >Logout</a>

                </form>
            </li>
        </ul>

    </div>
</div>
