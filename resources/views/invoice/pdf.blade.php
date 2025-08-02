{{-- filepath: resources/views/invoice/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $Order->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
            color: #2d3748;
        }
        
        .invoice-wrapper {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }
        
        .invoice-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 50px;
            border-radius: 24px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .invoice-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 50%, #43e97b 100%);
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(30deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(30deg); }
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }
        
        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
            position: relative;
            z-index: 1;
        }
        
        .invoice-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 30px;
        }
        
        .customer-info, .invoice-details {
            flex: 1;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .customer-info h3, .invoice-details h3 {
            color: #2d3748;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #4299e1;
        }
        
        .customer-info p, .invoice-details p {
            margin: 8px 0;
            font-size: 14px;
            color: #4a5568;
            font-weight: 500;
        }
        
        .order-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            margin: 30px 0;
        }
        
        .order-table thead th {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
            padding: 20px 16px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }
        
        .order-table tbody td {
            padding: 20px 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #2d3748;
            background: #fafafa;
        }
        
        .order-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .order-table tbody tr:hover {
            background: #f1f5f9;
            transition: background 0.2s ease;
        }
        
        .color-chip {
            display: inline-flex;
            align-items: center;
            background-color: {{ $Order->paintcolor }};
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            min-width: 100px;
            justify-content: center;
        }
        
        .price-cell {
            font-weight: 600;
            color: #1a365d;
            font-size: 16px;
        }
        
        .total-section {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            color: white;
            padding: 25px;
            border-radius: 16px;
            margin-top: 30px;
            text-align: right;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0;
            font-size: 16px;
        }
        
        .total-row.grand-total {
            font-size: 24px;
            font-weight: 700;
            padding-top: 15px;
            border-top: 2px solid rgba(255,255,255,0.2);
            margin-top: 15px;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
            padding: 30px 0;
        }
        
        .btn {
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn-download {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }
        
        .btn-download:hover {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
        }
        
        .btn-payment {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
        }
        
        .btn-payment:hover {
            background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
        }
        
        .btn-icon {
            font-size: 18px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }
        
        .decorative-element {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
        }
        
        .status-paid {
            position: absolute;
            top: 30px;
            right: 30px;
            transform: rotate(15deg);
            background: #48bb78;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
        }

        @media print {
            .action-buttons {
                display: none;
            }
            body {
                background: white;
                padding: 20px;
            }
            .invoice-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-wrapper">
        <div class="invoice-container">
            <div class="decorative-element"></div>
            <div class="status-paid">INVOICE</div>
            
            <div class="header">
                <h1>Paints Co</h1>
                <div class="subtitle">Professional Paint & Color Services</div>
            </div>

            <div class="invoice-meta">
                <div class="customer-info">
                    <h3>Bill To</h3>
                    <p><strong>{{ $Order->user->name ?? 'Valued Customer' }}</strong></p>
                    <p>{{ $Order->user->email ?? 'customer@email.com' }}</p>
                    <p>Phone: {{ $Order->phone ?? 'N/A' }}</p>
                    <p>Order ID: #{{ $Order->id }}</p>
                </div>
                
                <div class="invoice-details">
                    <h3>Invoice Details</h3>
                    <p><strong>Invoice #:</strong> INV-{{ str_pad($Order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Date:</strong> {{ now()->format('F j, Y') }}</p>
                    <p><strong>Status:</strong> <span class="badge">{{ ucfirst($Order->status) }}</span></p>
                    <p><strong>Payment:</strong> <span class="badge">Pending</span></p>
                </div>
            </div>

            <table class="order-table">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Paint Color</th>
                        <th>Specifications</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>{{ ucfirst($Order->paintCategory) }} Paint</strong><br>
                            <small style="color: #718096;">{{ ucfirst($Order->paintType) }} Finish</small>
                        </td>
                        <td>
                            <div class="color-chip">
                                {{ $Order->paintcolor }}
                            </div>
                        </td>
                        <td>
                            <strong>{{ $Order->quantity }}</strong> units<br>
                            <small style="color: #718096;">{{ $Order->capacity }}L per unit</small>
                        </td>
                        <td class="price-cell">
                            KES {{ number_format($Order->total_price, 2) }}
                        </td>
                    </tr>
                    @if($Order->painter_fee ?? false)
                        <tr>
                            <td>
                                <strong>Professional Painting Service</strong><br>
                                <small style="color: #718096;">Expert application service</small>
                            </td>
                            <td>-</td>
                            <td>Service Fee</td>
                            <td class="price-cell">
                                KES {{ number_format($Order->painter_fee, 2) }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>KES {{ number_format($Order->total_price, 2) }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total Amount:</span>
                    <span>KES {{ number_format(($Order->total_price ), 2) }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button onclick="downloadInvoice()" class="btn btn-download">
                    <span class="btn-icon">📥</span>
                    Download Invoice
                </button>
                <a href="{{ route('mpesa.index') }}" class="btn btn-payment">
                    <span class="btn-icon">💳</span>
                    Proceed to Payment
                </a>
            </div>

            <div class="footer">
                <p><strong>Thank you for choosing Paints Co!</strong></p>
                <p>For support, contact us at support@paintsco.com | +254 700 000 000</p>
                <p style="font-size: 12px; margin-top: 15px; color: #a0aec0;">
                    This is a computer-generated invoice. No signature required.
                </p>
            </div>
        </div>
    </div>

    <script>
        function downloadInvoice() {
            // Use html2pdf.js to generate and download PDF
            const element = document.querySelector('.invoice-container');
            // Hide action buttons before generating PDF
            const actionButtons = document.querySelector('.action-buttons');
            actionButtons.style.display = 'none';

            // Load html2pdf.js dynamically if not loaded
            if (typeof html2pdf === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js';
            script.onload = () => generatePDF();
            document.body.appendChild(script);
            } else {
            generatePDF();
            }

            function generatePDF() {
            html2pdf()
                .set({
                margin:       0.5,
                filename:     'invoice-{{ $Order->id }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
                })
                .from(element)
                .save()
                .then(() => {
                // Restore action buttons after download
                actionButtons.style.display = 'flex';
                });
            }
        }
    </script>
</body>
</html>