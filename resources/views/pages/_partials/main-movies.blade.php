<h1 class="pt-3 pb-3">{{ $title }}</h1>
<section class="d-flex main">
    <aside class="mb-3 mr-2">
        <ul>
            <li>
                <label>Sous-Genre</label>
                <ul class="ml-2">
                    <li>Romantique</li>
                    <li>À suspense</li>
                    <li>D'aventure</li>
                    <li>Émouvant</li>
                    <li>Sombre</li>
                    <li>Loufoque</li>
                    <li>Violent</li>
                </ul>
            </li><br>
            <li>
                <label>Lieu</label>
                <ul class="ml-2">
                    <li>Europe</li>
                    <li>Afrique</li>
                    <li>Asie</li>
                    <li>Amérique</li>
                </ul>
            </li>
        </ul>
    </aside>

    <div class="row">
        <!-- TODO: edit foreach with elk data-->
        @for($i = 0; $i < 4; $i++)
        <div class="col-md-3">
            <img src="{{ asset('/images/Ma.jpg') }}" alt="" class="img-responsive">
        </div> 
        @endfor
    </div>
</section>
