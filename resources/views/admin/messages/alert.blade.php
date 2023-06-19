
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('success') }}.
    </div>


@endif
@if (session()->has('error'))

    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('error') }}.
    </div>

@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif
@if (session()->has('error'))
    <script>
        window.onload = function() {
            notif({
                msg: "لايمكن الوصول الى هذه الصفحة",
                type: "error"
            })
        }
    </script>
@endif
@if (session()->has('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "تمت العملية بنجاح",
                type: "success"
            })
        }
    </script>
@endif

