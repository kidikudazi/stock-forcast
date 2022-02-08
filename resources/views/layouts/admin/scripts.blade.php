<script src="{{ asset('assets/admin/js/vendors.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(Session::has('success'))
        window.addEventListener('load', () => {
            toastr.success('{{ session('success') }}', 'Success');
        });

        window.setTimeout(()=> {
            @php session()->forget('success'); @endphp
        }, 8000);
    @endif

    @if(Session::has('error'))
        window.addEventListener('load', () => {
            toastr.error('{{ session('error') }}', 'Error');
        });

        window.setTimeout(()=> {
            @php session()->forget('success'); @endphp
        }, 8000);
    @endif

    // logout handler
    $('body').on('click', '#logout-link', function(){
        $('#logout-form').submit();
    });
    
    $("#list").DataTable({
        destroy: true,
        responsive: true,
        select: true,
        columnsDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 1, targets: 0 },
        ]
    });

    // activity time
    let timeoutInMiliseconds = 1200000;
    let timeoutId;

    const resetTimer = () => {
        window.clearTimeout(timeoutId)
        startTimer();
    }
    
    const startTimer = () => {
        // window.setTimeout returns an Id that can be used to start and stop a timer
        timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds);
    }
    
    const doInactive = () => {
        // does whatever you need it to actually do - probably signs them out or stops polling the server for info
        window.location.reload();
    }
    
    const setupTimers = () => {
        document.addEventListener("mousemove", resetTimer, false);
        document.addEventListener("mousedown", resetTimer, false);
        document.addEventListener("keypress", resetTimer, false);
        document.addEventListener("touchmove", resetTimer, false);
        
        startTimer();
    };

    $(document).ready(() => {
        setupTimers();
    });
</script>