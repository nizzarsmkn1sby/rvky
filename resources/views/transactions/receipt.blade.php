<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger - {{ $transaction->invoice_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 40px;
            width: 320px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -1.5px;
            text-transform: uppercase;
            line-height: 1;
        }
        .brand-sub {
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            opacity: 0.3;
            margin-top: 4px;
        }
        .divider {
            border-top: 1px solid #eee;
            margin: 20px 0;
        }
        .info-grid {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            text-transform: uppercase;
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #888;
        }
        .info-row span:last-child {
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            color: #888;
        }
        td {
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }
        .item-name {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: -0.2px;
        }
        .item-meta {
            font-size: 8px;
            opacity: 0.4;
            font-weight: 700;
        }
        .summary {
            margin-top: 20px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .total-row {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #000;
            display: flex;
            justify-content: space-between;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: -0.5px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        .footer-text {
            font-size: 8px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.2;
        }
        @media print {
            body { padding: 20px; width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <div class="logo">RVKY</div>
        <div class="brand-sub">Intelligence</div>
    </div>

    <div class="info-grid">
        <div class="info-row"><span>Ledger ID</span> <span>{{ $transaction->invoice_number }}</span></div>
        <div class="info-row"><span>Timestamp</span> <span>{{ $transaction->created_at->format('d.m.Y / H:i') }}</span></div>
        <div class="info-row"><span>Operator</span> <span>{{ $transaction->user->name }}</span></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Entity Description</th>
                <th style="text-align: center">Qty</th>
                <th style="text-align: right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
            <tr>
                <td>
                    <div class="item-name">{{ $detail->product->name }}</div>
                    <div class="item-meta">Base: {{ number_format($detail->product->price, 0, ',', '.') }}</div>
                </td>
                <td style="text-align: center; font-weight: 700;">{{ $detail->qty }}</td>
                <td style="text-align: right; font-weight: 800;">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-row" style="opacity: 0.4;"><span>Sub-Aggregate</span> <span>{{ number_format($transaction->total_price * 0.9, 0, ',', '.') }}</span></div>
        <div class="summary-row" style="opacity: 0.4;"><span>Tax Index (10%)</span> <span>{{ number_format($transaction->total_price * 0.1, 0, ',', '.') }}</span></div>
        <div class="total-row"><span>Aggregate</span> <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span></div>
        
        <div class="divider"></div>
        
        <div class="summary-row"><span>Tendered</span> <span>{{ number_format($transaction->pay, 0, ',', '.') }}</span></div>
        <div class="summary-row" style="font-weight: 800;"><span>Balance Refund</span> <span>{{ number_format($transaction->change, 0, ',', '.') }}</span></div>
    </div>

    <div class="footer">
        <div class="footer-text">Transaction Verified</div>
        <div class="footer-text" style="margin-top: 5px;">RVKY POS • Obsidian Node 01</div>
    </div>

    <div class="no-print" style="margin-top: 40px; text-align: center;">
        <button onclick="window.close()" style="padding: 12px 30px; background: #000; color: #fff; border: none; border-radius: 12px; cursor: pointer; font-[9px]; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">Close Session</button>
    </div>
</body>
</html>
