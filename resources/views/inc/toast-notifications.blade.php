@if ($errors->all())
    @foreach($errors->all() as $error)
        <script>
            M.toast({html: '<span>{!! $error !!}</span>',
                displayLength:8000,
                classes:'red',
            })
        </script>
    @endforeach
@endif
@if (session()->has('message'))
    <script>
        M.toast({html: '<span>{{session()->get('message')}}</span>',
            displayLength:6000,
        })
    </script>
@endif