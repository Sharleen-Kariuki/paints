{{-- filepath: resources/views/mpesa/index.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Mpesa Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 40px;
            background-color: #f5f5f5;
        }
        .container { 
            max-width: 400px; 
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        label { 
            display: block; 
            margin-top: 20px;
            font-weight: bold;
            color: #34495e;
        }
        input[type="text"], input[type="number"] { 
            width: 100%; 
            padding: 12px; 
            margin-top: 5px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .amount { 
            background: #f0f0f0;
            color: #666;
        }
        button { 
            margin-top: 30px; 
            padding: 12px 30px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #219a52;
        }
        button:disabled {
            background: #95a5a6;
            cursor: not-allowed;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .message {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            display: none;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .phone-format {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🎨 Paint Company - M-Pesa Payment</h2>
    
    <form method="POST"  action="{{ route('mpesa.stkpush') }}" >
        @csrf
        <label for="phone">M-Pesa Phone Number:</label>
        <input type="text" id="phone" name="phone" 
               placeholder="254721483296" 
               value="{{ $PhoneNumber ?? '254721483296' }}" 
               pattern="[0-9]{12}" 
               maxlength="12"
               required>
        <div class="phone-format">Format: 254XXXXXXXXX (start with 254)</div>

        <label for="amount">Amount (KSH):</label>
        <input type="number" id="amount" name="amount" 
               class="amount" 
               value="{{ $Amount ?? 1 }}" 
               min="1" 
               readonly>

        <label for="reference">Order Reference:</label>
        <input type="text" id="reference" name="reference" 
               value="Paint-{{ now()->format('YmdHis') }}" 
               readonly>

        <button type="submit" id="payButton">
            💳 Pay with M-Pesa
        </button>
    </form>

    <div class="loading" id="loading">
        <p>⏳ Processing payment... Please check your phone for M-Pesa prompt.</p>
    </div>

    <div class="message" id="message"></div>
</div>

{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
     const loading = document.getElementById('loading');
    // const form = document.getElementById('mpesaForm');
    // const payButton = document.getElementById('payButton');
    // const message = document.getElementById('message');
    // const phoneInput = document.getElementById('phone');

    // Format phone number as user types
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove non-digits
        
        // Ensure it starts with 254
        if (value.length > 0 && !value.startsWith('254')) {
            if (value.startsWith('0')) {
                value = '254' + value.substring(1);
            } else if (value.startsWith('7') || value.startsWith('1')) {
                value = '254' + value;
            }
        }
        
        // Limit to 12 digits
        if (value.length > 12) {
            value = value.substring(0, 12);
        }
        
        this.value = value;
    });

    function showMessage(text, type) {
        message.textContent = text;
        message.className = 'message ' + type;
        message.style.display = 'block';
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const phone = formData.get('phone');
        const amount = formData.get('amount');
        const reference = formData.get('reference');

        // Validate phone number
        if (!/^254[0-9]{9}$/.test(phone)) {
            showMessage('Please enter a valid M-Pesa number (format: 254XXXXXXXXX)', 'error');
            return;
        }

        // Show loading state
        payButton.disabled = true;
        payButton.textContent = 'Processing...';
        loading.style.display = 'block';
        message.style.display = 'none';

        // Make payment request
        fetch('{{ route("mpesa.stkpush") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                phone: phone,
                amount: parseInt(amount),
                reference: reference
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Payment response:', data);
            
            if (data.success) {
                showMessage('✅ Payment request sent! Please check your phone for M-Pesa prompt.', 'success');
                
                // Check payment status after 30 seconds
                setTimeout(checkPaymentStatus, 30000);
            } else {
                showMessage('❌ Payment failed: ' + (data.error || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            console.error('Payment error:', error);
            showMessage('❌ Payment request failed. Please try again.', 'error');
        })
        .finally(() => {
            payButton.disabled = false;
            payButton.textContent = '💳 Pay with M-Pesa';
            loading.style.display = 'none';
        });
    });

    function checkPaymentStatus() {
        fetch('{{ route("mpesa.session-data") }}')
        .then(response => response.json())
        .then(data => {
            if (data.payment_pending === false) {
                showMessage('✅ Payment completed successfully!', 'success');
            } else {
                showMessage('⏳ Payment still pending. Please complete the M-Pesa transaction.', 'error');
            }
        })
        .catch(error => {
            console.error('Status check error:', error);
        });
    }
});
</script> --}}

</body>
</html>