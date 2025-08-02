<h2>Paint Formulation for Order #{{ $order->id }}</h2>

@if(isset($formula['materials']) && is_array($formula['materials']) && count($formula['materials']) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Material</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formula['materials'] as $material)
                <tr>
                    <td>{{ $material['name'] }}</td>
                    <td>{{ $material['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No materials returned or response was not valid.</p>
    <pre>{{ $formulaJson }}</pre>
@endif
