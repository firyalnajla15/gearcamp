@extends('admin.layouts.app')

@section('title', 'Detail Transaksi')
@section('page-heading', 'Detail Transaksi')

@section('content')

<style>
    /* Import Font Premium */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:wght@600;700&display=swap');

    .detail-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #26352b;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #edf1ed;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px -8px rgba(0,0,0,.03);
    }

    .detail-title {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        color: #10271c;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .detail-label {
        color: #7b887e;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #111827;
        font-weight: 600;
        font-size: 14.5px;
        overflow-wrap: anywhere;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu { background: #fef3c7; color: #b45309; border: 1px solid #fcd34d; }
    .status-diproses { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .status-disewa { background: #ede9fe; color: #6d28d9; border: 1px solid #ddd6fe; }
    .status-selesai { background: #eaf2ed; color: #1f4d3a; border: 1px solid #a7f3d0; }
    .status-ditolak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
    .status-dibatalkan { background: #f3f4f6; color: #4b5563; border: 1px solid #d1d5db; }

    /* Tabel */
    .table thead th {
        background: #f7f9f7;
        color: #7b887e;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        padding: 14px 16px;
        border-bottom: 1px solid #edf1ed;
    }
    .table td {
        vertical-align: middle;
        font-size: 14px;
        padding: 14px 16px;
        border-bottom: 1px solid #edf1ed;
    }

    /* Summary Box */
    .summary-box {
        background: #fafbfa;
        border: 1px solid #edf1ed;
        border-radius: 12px;
        padding: 16px 20px;
        height: 100%;
    }

    .completed-box {
        background: #eaf2ed;
        border: 1px solid #a7f3d0;
        border-radius: 12px;
        padding: 16px;
    }

    .warning-box {
        background: #fff8e8;
        border: 1px solid #f2e2b7;
        border-radius: 12px;
        padding: 16px;
    }

    .cancelled-box {
        background: #fee2e2;
        border: 1px solid #fca5a5;
        border-radius: 12px;
        padding: 20px;
    }

    /* Timeline */
    .timeline-item {
        border-left: 2px solid #e5e7eb;
        padding: 0 0 25px 20px;
        position: relative;
    }
    .timeline-item:last-child { padding-bottom: 0; border-left-color: transparent; }
    .timeline-item::before {
        content: '';
        position: absolute;
        width: 12px;
        height: 12px;
        background: #1f4d3a;
        border: 2px solid white;
        border-radius: 50%;
        left: -7px;
        top: 3px;
        box-shadow: 0 0 0 2px #eaf2ed;
    }

    /* Tombol Kustom */
    .action-btn { border-radius: 10px; font-size: 14px; font-weight: 600; padding: 10px 18px; transition: all 0.2s ease; }
    .btn-green { background: #1f4d3a; color: #fff; border: none; }
    .btn-green:hover { background: #10271c; color: #fff; transform: translateY(-2px); }