@if ($message = Session::get('msg'))
    <div class="container position-relative" id="success-alert">

        <div class="position-absolute top-0 end-0 p-3 success-alert" style="z-index:999;margin-top:-90px; ">

            <div class="toast show ">

                <div class="toast-header">

                    <strong class="me-auto">ប្រវត្តិរូបមន្រ្តី</strong>

                    <button type="button" class="btn-close text-white" data-bs-dismiss="toast"></button>

                </div>

                <div class="toast-body text-success">

                    <b>{{ $message }}</b>

                </div>

            </div>

        </div>

    </div>
@endif
