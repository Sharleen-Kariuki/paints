 
 @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route("order.submit")}}">
@csrf
{{-- <input type="hidden" name="order_type" value="online"> <!-- or "physical" -->
--}}
   <input type="hidden" name="paintCategory" value="{{ $category }}">
<input type="hidden" name="paintType" value="{{ $type }}"> 
<div class="mb-3">
    <label for="quantity" class="form-label">Select Capacity (L):</label>
     <select class="form-select" id="quantity" name="quantity">
        <option value="20">20L</option>
        <option value="10">10L</option>
        <option value="5">4L</option>
    </select>
</div>



     
        <div >
    <label for="capacity" class="form-label">Enter Quantity:</label>
   <input type="number" class="form-control" id="capacity" name="capacity" min="1" placeholder="Enter Quantity">
</div>
    <label class="form-label">Choose Paint Color:</label>
    <div class="container">

    <div class="wall-container">
        <img src="{{ asset('images/customizable picture.jpg') }}" alt="Wall" class="wall-image">
        <div class="wall-overlay" id="wallOverlay"></div>
    </div>

<!-- Color Picker Target -->
<div id="color-picker"></div>
<input type="hidden" name="paintcolor" id="selectedColor">
<p id="colorPreviewText">Color Preview</p> <!-- Optional visual feedback -->
    <br>
</div>

{{-- <div class="mb-3">
    <label class="form-label">Do you need a painter?</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="needs_painter" id="needPainterYes" value="yes">
            <label class="form-check-label" for="needPainterYes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="needs_painter" id="needPainterNo" value="no" checked>
            <label class="form-check-label" for="needPainterNo">No</label>
        </div>
    </div>
</div> --}}

{{-- <div class="mb-3" id="descriptionArea" style="display: none;">
    <label for="description" class="form-label">Description of area to be painted:</label>
    <input type="text" class="form-control" id="description" name="description" min="1" placeholder="e.g. kitchen wall 2m by 3m">
</div> --}}
<input type="hidden" name="order_type" value="online">
<input type="hidden" name="status" value="pending">


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const yesRadio = document.getElementById('needPainterYes');
        const noRadio = document.getElementById('needPainterNo');
        const descriptionArea = document.getElementById('descriptionArea');

        function toggleDescription() {
            if (yesRadio.checked) {
                descriptionArea.style.display = '';
            } else {
                descriptionArea.style.display = 'none';
            }
        }

        yesRadio.addEventListener('change', toggleDescription);
        noRadio.addEventListener('change', toggleDescription);

        toggleDescription();
    });
</script> --}}

@if (!session()->has('loginId'))
    <div class="alert alert-warning">
        You must login first to submit an order.
    </div>
@else
    <div class="mb-3">
        <button class="btn btn-success" type="submit">
            Submit Order
        </button>
    </div>
@endif

</div>
</form>





@endsection
@push('scripts') 
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr">
</script> 
<script>    
document.addEventListener('DOMContentLoaded', () => {  
     const overlay = document.getElementById('wallOverlay');
        const hiddenInput = document.getElementById('selectedColor');



           const pickr = Pickr.create({     
                    el: '#color-picker',    
                    theme: 'classic',      
                    default: '#3498db',   
                components: {                 
                    preview: true,
                    opacity: true,                 
                    hue: true,                 
                interaction: {                     
                    hex: true,                     
                    rgba: true,                     
                    input: true,                     
                    save: true                 
                }             
            }         
        });          
               // Update input & preview live as user picks a color
         pickr.on('change', (color) => {
            const rgba = color.toRGBA().toString(); // rgba(…, …, …, …)
            overlay.style.backgroundColor = rgba;
            hiddenInput.value = color.toHEXA().toString();
        });

        pickr.on('save', (color) => {
            const rgba = color.toRGBA().toString();
            overlay.style.backgroundColor = rgba;
            hiddenInput.value = color.toHEXA().toString();
            pickr.hide();
        });
    });
</script> 
@endpush