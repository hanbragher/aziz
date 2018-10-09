{{--<div class="col s6 m4 l3"> include </div> full view--}}


{{--<div class="row center">
    <div class="col s12 m4 l1 hide-on-med-and-down"></div>

    <div class="col s12 m12 l10">

        <div class="row">
            @for ($i=1; $i<=10; $i++)
                <div class="col s6 m4 l3">
                    @include('widgets.card')
                </div>
            @endfor


        </div>

    </div>--}}


<div class="card">
    <div class="card-image waves-effect waves-block waves-light">
        {{--<a href="#"><img class="activator" src="images/card.jpg"></a>--}}
        <a href="#"><img  src="images/card.jpg"></a>
    </div>
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
        <a class="chip" href="#">tag</a>
    </div>
    <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
        <p><a href="#">asas</a>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
</div>