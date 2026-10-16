<style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;

            padding: 0 32px;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;

            font-size: 15px;
            font-weight: 700;

            min-width: 0;
            color: inherit;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border: 1px solid #eef0f3;
            border-radius: 8px;
            background: #ffffff;
        }

        .brand-logo img {
            display: block;
            width: auto;
            max-width: 128px;
            height: 25px;
            object-fit: contain;
        }

        .brand-divider {
            width: 1px;
            height: 28px;
            background: #e5e7eb;
        }

        .brand-title {
            color: #334155;
        }

        .brand-mark {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #6366f1;
            color: white;

            font-size: 14px;
            font-weight: 700;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        .avatar {
            width: 32px;
            height: 32px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #e0f2fe;
            color: #0369a1;

            font-size: 12px;
            font-weight: 600;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 1px;
            max-width: 220px;
            overflow: hidden;
        }

        .user-name {
            font-size: 12px;
            font-weight: 600;
            color: #111827;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role {
            font-size: 10px;
            color: #9ca3af;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .account-menu {
            position: relative;
        }

        .account-menu > summary {
            cursor: pointer;
            list-style: none;
        }

        .account-menu > summary::-webkit-details-marker {
            display: none;
        }

        .account-menu > summary:focus-visible {
            outline: 2px solid #0284c7;
            outline-offset: 3px;
            border-radius: 8px;
        }

        .account-chevron {
            width: 15px;
            height: 15px;
            flex: 0 0 auto;
            color: #94a3b8;
            transition: transform 0.15s ease;
        }

        .account-menu[open] .account-chevron {
            transform: rotate(180deg);
        }

        .account-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            z-index: 120;
            width: 220px;
            padding: 8px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 12px 28px rgb(15 23 42 / 14%);
        }

        .account-dropdown-email {
            overflow: hidden;
            margin: 0;
            padding: 7px 9px 10px;
            border-bottom: 1px solid #e5e7eb;
            color: #64748b;
            font-size: 11px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .theme-toggle,
        .logout-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #ffffff;
            color: #475569;
            cursor: pointer;
            transition: background 0.15s ease, border-color 0.15s ease, color 0.15s ease;
        }

        .theme-toggle {
            width: 36px;
            padding: 0;
        }

        .theme-toggle svg,
        .logout-button svg {
            width: 17px;
            height: 17px;
        }

        .theme-toggle .icon-sun {
            display: none;
        }

        .dark .theme-toggle .icon-moon {
            display: none;
        }

        .dark .theme-toggle .icon-sun {
            display: block;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            gap: 8px;
            padding: 0 11px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
        }

        .account-dropdown .logout-button {
            width: 100%;
            justify-content: flex-start;
            margin-top: 5px;
            padding: 0 9px;
            border-color: transparent;
            background: transparent;
            color: #b91c1c;
        }

        .account-dropdown .logout-button:hover {
            border-color: transparent;
            background: #fef2f2;
            color: #991b1b;
        }

        .theme-toggle:hover,
        .logout-button:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #0f172a;
        }

        .theme-toggle:focus-visible,
        .logout-button:focus-visible {
            outline: 2px solid #0284c7;
            outline-offset: 2px;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px;
        }

        .header {
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .header p {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        /* =========================
           TABS
        ========================= */

        .tabs {
            display: flex;
            align-items: center;

            gap: 4px;

            margin-bottom: 24px;

            border-bottom: 1px solid #e5e7eb;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .tab {
            position: relative;

            padding: 12px 16px;

            color: #6b7280;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;

            transition: color 0.15s ease;
        }

        .tab:hover {
            color: #111827;
        }

        .tab.active {
            color: #4f46e5;
        }

        .tab.active::after {
            content: "";

            position: absolute;

            left: 12px;
            right: 12px;
            bottom: -1px;

            height: 2px;

            background: #6366f1;

            border-radius: 2px;
        }

        /* =========================
           STATS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));

            gap: 18px;

            margin-bottom: 28px;
        }

        .card {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            padding: 22px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .card-label {
            color: #6b7280;

            font-size: 13px;
            font-weight: 500;

            margin-bottom: 10px;
        }

        .card-value {
            font-size: 30px;
            font-weight: 700;

            letter-spacing: -0.03em;
        }

        /* =========================
           TABLE CARD
        ========================= */

        .table-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            overflow: hidden;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .table-header h2 {
            font-size: 17px;
            font-weight: 600;
        }

        .table-header span {
            display: block;

            margin-top: 4px;

            color: #9ca3af;
            font-size: 12px;
        }

        /* =========================
           ACTIONS
        ========================= */

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .primary-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 8px 12px;

            border: 1px solid #6366f1;
            border-radius: 7px;

            background: #6366f1;
            color: #ffffff;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .primary-button:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .action-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border: 1px solid #fecaca;
            border-radius: 6px;

            background: #ffffff;
            color: #dc2626;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.15s ease;
        }

        .action-button:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 32px;
            padding: 0 10px;

            border-radius: 6px;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            box-sizing: border-box;

            transition: all 0.15s ease;
        }

        .action-view {
            background: #ffffff;
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .action-view:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .action-revoke {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 32px;
            padding: 0 10px;

            border: 1px solid #fecaca;
            border-radius: 6px;

            background: #ffffff;
            color: #dc2626;

            font-family: inherit;
            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.15s ease;
        }

        .action-revoke:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .token-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .token-actions form {
            margin: 0;
        }

        .secondary-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .secondary-button:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* =========================
           FILTERS
        ========================= */

        .table-filters {
            display: flex;

            flex-wrap: wrap;
            align-items: center;

            gap: 12px;

            padding: 12px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .filter-group {
            display: flex;

            align-items: center;

            gap: 6px;
        }

        .filter-label {
            color: #6b7280;

            font-size: 12px;
            font-weight: 500;

            white-space: nowrap;
        }

        .filter-select,
        .filter-input {
            height: 32px;

            padding: 0 9px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-family: inherit;

            font-size: 12px;
            font-weight: 500;

            transition: all 0.15s ease;
        }

        .filter-select {
            cursor: pointer;
        }

        .filter-input::placeholder {
            color: #9ca3af;
        }

        .filter-select:hover,
        .filter-input:hover {
            border-color: #d1d5db;
        }

        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: #6366f1;
        }

        .filter-submit {
            height: 32px;

            padding: 0 12px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;
        }

        .filter-submit:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* =========================
           TABLE
        ========================= */

        .table-wrapper,
        .table-responsive,
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 950px;
        }

        th,
        td {
            padding: 15px 22px;
            text-align: left;
            border-bottom: 1px solid #f1f3f5;
        }

        th {
            background: #fafafa;
            color: #6b7280;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 14px;
            color: #374151;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           USER ID
        ========================= */

        .user-id {
            display: inline-flex;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f3f4f6;

            color: #374151;

            font-family: monospace;
            font-size: 12px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 5px 9px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 600;
        }

        .status::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .status-active {
            background: #ecfdf5;
            color: #047857;
        }

        .status-active::before {
            background: #10b981;
        }

        .status-expired {
            background: #fffbeb;
            color: #b45309;
        }

        .status-expired::before {
            background: #f59e0b;
        }

        .status-revoked {
            background: #fef2f2;
            color: #b91c1c;
        }

        .status-revoked::before {
            background: #ef4444;
        }

        /* =========================
           LOG STATUS
        ========================= */

        .log-status {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 42px;

            padding: 5px 8px;

            border-radius: 6px;

            font-size: 11px;
            font-weight: 700;
        }

        .log-status-success {
            background: #ecfdf5;
            color: #047857;
        }

        .log-status-client-error {
            background: #fffbeb;
            color: #b45309;
        }

        .log-status-server-error {
            background: #fef2f2;
            color: #b91c1c;
        }

        .log-method {
            display: inline-flex;

            padding: 4px 7px;

            border-radius: 5px;

            background: #f3f4f6;

            color: #374151;

            font-family: monospace;
            font-size: 11px;
            font-weight: 600;
        }

        .log-url {
            max-width: 360px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            font-family: monospace;
            font-size: 12px;
            color: #4b5563;
        }

        .log-token {
            font-weight: 600;
            color: #374151;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty {
            padding: 40px 20px;

            text-align: center;

            color: #9ca3af;

            font-size: 14px;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            display: flex;

            align-items: center;
            justify-content: space-between;

            padding: 16px 22px;

            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            color: #6b7280;

            font-size: 12px;
        }

        .pagination-links {
            display: flex;

            align-items: center;

            gap: 4px;
        }

        .pagination-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 32px;
            height: 32px;

            padding: 0 9px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 500;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .pagination-button:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .pagination-button.active {
            background: #6366f1;
            border-color: #6366f1;
            color: #ffffff;
        }

        .pagination-button.disabled {
            color: #d1d5db;
            background: #f9fafb;
            cursor: not-allowed;
        }

        /* =========================
           SUCCESS
        ========================= */

        .success-message {
            margin-bottom: 20px;

            padding: 12px 16px;

            background: #ecfdf5;

            border: 1px solid #a7f3d0;
            border-radius: 8px;

            color: #047857;

            font-size: 13px;
        }

        /* Tabla de aplicaciones */
.table-container {
    width: 100%;
    overflow-x: auto;
}

.applications-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
    table-layout: fixed;
}

.applications-table th,
.applications-table td {
    padding: 16px 18px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #e9edf3;
    overflow-wrap: anywhere;
}

.applications-table th {
    background: #f8fafc;
    color: #64748b;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.applications-table tbody tr {
    transition: background 0.15s ease;
}

.applications-table tbody tr:hover {
    background: #fafbff;
}

.applications-table tbody tr:last-child td {
    border-bottom: none;
}

/* Distribución de columnas */
.applications-table th:nth-child(1) { width: 19%; }
.applications-table th:nth-child(2) { width: 11%; }
.applications-table th:nth-child(3) { width: 23%; }
.applications-table th:nth-child(4) { width: 8%; }
.applications-table th:nth-child(5) { width: 13%; }
.applications-table th:nth-child(6) { width: 26%; }

.application-name strong,
.oauth-cell strong {
    display: block;
    color: #172033;
    font-size: 13px;
    font-weight: 600;
}

.application-name span {
    display: block;
    margin-top: 4px;
    color: #64748b;
    font-size: 12px;
    line-height: 1.5;
}

.slug {
    color: #475569;
    font-size: 12px;
    overflow-wrap: anywhere;
}

.oauth-cell small {
    display: block;
    margin-top: 5px;
    color: #64748b;
    font-size: 11px;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.oauth-status {
    display: block;
    margin-top: 5px;
    color: #64748b;
    font-size: 11px;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    padding: 5px 9px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.status-active {
    color: #166534;
    background: #dcfce7;
}

.status-inactive {
    color: #991b1b;
    background: #fee2e2;
}

.date-cell {
    color: #475569;
    font-size: 12px;
    white-space: nowrap;
}

/* Acciones agrupadas */
.actions-heading {
    white-space: nowrap;
}

.application-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.application-actions form {
    margin: 0;
}

.btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    min-height: 34px;
    padding: 8px 11px;
    border: 1px solid transparent;
    border-radius: 7px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 600;
    line-height: 1.2;
    white-space: nowrap;
    cursor: pointer;
    transition: background 0.15s ease, border-color 0.15s ease;
}

.btn-primary {
    color: #fff;
    background: #625cf5;
}

.btn-primary:hover {
    background: #5048e5;
}

.btn-danger {
    color: #dc2626;
    background: #fff;
    border-color: #fecaca;
}

.btn-danger:hover {
    background: #fef2f2;
    border-color: #f87171;
}

.btn-sm {
    font-size: 11px;
}

.muted {
    color: #94a3b8;
    font-size: 12px;
}

.empty-state {
    padding: 36px !important;
    color: #64748b;
    text-align: center !important;
}

.pagination-container {
    padding: 16px 20px;
    border-top: 1px solid #e9edf3;
}


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .topbar {
                padding: 0 16px;
                gap: 10px;
            }

            .topbar-brand {
                min-width: auto;
            }

            .user-role {
                display: none;
            }

            .user-details {
                max-width: 180px;
            }

            .topbar-actions {
                gap: 8px;
            }

            .main {
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .table-filters {
                align-items: stretch;

                flex-direction: column;
            }

            .filter-group {
                justify-content: space-between;
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-input,
            .filter-select {
                width: 100%;
            }

            .pagination {
                align-items: flex-start;

                flex-direction: column;

                gap: 12px;
            }

            .pagination-links {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 520px) {
            .topbar {
                padding: 0 12px;
            }

            .topbar-brand {
                gap: 8px;
            }

            .brand-logo {
                padding: 4px 6px;
            }

            .brand-logo img {
                max-width: 105px;
                height: 22px;
            }

            .brand-title,
            .brand-divider,
            .avatar {
                display: none;
            }

            .user-details {
                max-width: 145px;
            }

            .account-dropdown {
                width: min(220px, calc(100vw - 24px));
            }

            .main {
                padding: 16px 12px;
            }

            .table-header {
                align-items: flex-start;
                flex-wrap: wrap;
                gap: 12px;
                padding: 16px;
            }

            .table-filters {
                padding: 12px 16px;
            }

            .table-header .header-actions,
            .table-header .primary-button {
                width: 100%;
            }

            .table-header .primary-button {
                min-height: 38px;
            }

            .pagination {
                padding: 14px 16px;
            }
        }

        .page-content {
            width: 100%;
            max-width: 920px;
            margin: 0 auto;
        }

        .page-content--wide {
            max-width: 1200px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }

        .page-heading h1 {
            margin: 0;
            color: #172033;
            font-size: 27px;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.55;
        }

        .page-back-link {
            flex: 0 0 auto;
        }

        .page-back-link svg {
            width: 16px;
            height: 16px;
        }

        .form-card,
        .detail-card {
            padding: 28px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 2px 8px rgb(15 23 42 / 4%);
        }

        .form-card + .form-card,
        .detail-card + .detail-card {
            margin-top: 18px;
        }

        .form-grid,
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-field {
            min-width: 0;
        }

        .form-field--full {
            grid-column: 1 / -1;
        }

        .form-field label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #ffffff;
            color: #172033;
            font: inherit;
            font-size: 14px;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .form-control:focus {
            outline: none;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgb(2 132 199 / 14%);
        }

        .form-control[readonly],
        .form-value {
            background: #f8fafc;
            color: #334155;
        }

        .form-value {
            display: flex;
            align-items: center;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            overflow-wrap: anywhere;
        }

        .form-value--mono,
        .secret-value {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 13px;
        }

        .field-hint {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .field-error {
            margin: 6px 0 0;
            color: #b42318;
            font-size: 12px;
            line-height: 1.45;
        }

        .form-error-summary,
        .notice {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.55;
        }

        .form-error-summary {
            border-color: #fecaca;
            background: #fef2f2;
            color: #991b1b;
        }

        .form-error-summary ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .notice-success {
            border-color: #a7f3d0;
            background: #ecfdf5;
            color: #047857;
        }

        .notice-warning {
            border-color: #fde68a;
            background: #fffbeb;
            color: #92400e;
        }

        .form-actions,
        .page-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 26px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.2;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.15s ease, border-color 0.15s ease, color 0.15s ease;
        }

        .button:focus-visible {
            outline: 2px solid #0284c7;
            outline-offset: 2px;
        }

        .button-primary {
            background: #0866a8;
            color: #ffffff;
        }

        .button-primary:hover {
            background: #07578f;
        }

        .button-secondary {
            border-color: #dbe2ea;
            background: #ffffff;
            color: #334155;
        }

        .button-secondary:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .button-copy {
            flex: 0 0 auto;
        }

        .app-modal {
            position: fixed;
            inset: 0;
            width: min(480px, calc(100vw - 32px));
            max-width: none;
            height: fit-content;
            max-height: calc(100vh - 32px);
            margin: auto;
            overflow: auto;
            padding: 0;
            border: 0;
            border-radius: 14px;
            background: transparent;
            color: #172033;
            box-shadow: 0 24px 64px rgb(15 23 42 / 24%);
        }

        .app-modal::backdrop {
            background: rgb(15 23 42 / 56%);
            backdrop-filter: blur(3px);
        }

        .app-modal-card {
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #ffffff;
        }

        .app-modal-icon {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            margin-bottom: 16px;
            border-radius: 12px;
            background: #fff7ed;
            color: #c2410c;
        }

        .app-modal-icon svg {
            width: 21px;
            height: 21px;
        }

        .app-modal h2 {
            margin: 0;
            color: #172033;
            font-size: 18px;
            font-weight: 700;
        }

        .app-modal p {
            margin: 9px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .app-modal-actions {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 24px;
        }

        .app-modal-actions .button {
            min-width: 104px;
        }

        .app-modal-actions .button-danger {
            border-color: #dc2626;
            background: #dc2626;
            color: #ffffff;
        }

        .app-modal-actions .button-danger:hover {
            border-color: #b91c1c;
            background: #b91c1c;
        }

        .detail-label {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .detail-value {
            color: #172033;
            font-size: 14px;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .credential-list {
            display: grid;
            gap: 18px;
        }

        .credential-intro {
            margin: 0 0 20px;
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
        }

        .credential-row {
            display: flex;
            align-items: stretch;
            gap: 10px;
        }

        .credential-row .form-control {
            min-width: 0;
        }

        .secret-value {
            display: block;
            min-width: 0;
            flex: 1;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #f8fafc;
            color: #172033;
            overflow-wrap: anywhere;
            user-select: all;
        }

        .copy-feedback {
            min-height: 18px;
            margin: 5px 0 0;
            color: #047857;
            font-size: 12px;
        }

        @media (max-width: 800px) {
            .form-card,
            .detail-card {
                padding: 22px;
            }
        }

        @media (max-width: 600px) {
            .page-heading {
                flex-direction: column;
                gap: 12px;
                margin-bottom: 16px;
            }

            .page-heading h1 {
                font-size: 24px;
            }

            .page-back-link {
                min-height: 36px;
            }

            .form-grid,
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .form-field--full {
                grid-column: auto;
            }

            .form-card,
            .detail-card {
                padding: 18px;
            }

            .form-actions > .button,
            .page-actions > .button {
                flex: 1 1 auto;
            }

            .credential-row {
                flex-direction: column;
            }

            .credential-row .button {
                width: 100%;
            }
        }

        .dark body {
            background: #0b1220;
            color: #e2e8f0;
        }

        .dark .topbar {
            height: 68px;
            background: #111827;
            border-top: 4px solid #05b8c5;
            border-right-color: #263449;
            border-bottom-color: #263449;
            border-left-color: #263449;
        }

        .dark .brand-logo {
            border-color: #334155;
        }

        .dark .brand-divider {
            background: #334155;
        }

        .dark .brand-title,
        .dark .user-name,
        .dark .header h1,
        .dark .table-header h2,
        .dark .application-name strong,
        .dark .oauth-cell strong {
            color: #f1f5f9;
        }

        .dark .user-role,
        .dark .header p,
        .dark .card-label,
        .dark .table-header span,
        .dark .filter-label,
        .dark .pagination-info,
        .dark .application-name span,
        .dark .oauth-cell small,
        .dark .oauth-status,
        .dark .muted,
        .dark .empty-state {
            color: #94a3b8;
        }

        .dark .tabs {
            border-color: #263449;
        }

        .dark .tab {
            color: #94a3b8;
        }

        .dark .tab:hover,
        .dark .tab.active {
            color: #67e8f9;
        }

        .dark .tab.active::after {
            background: #22d3ee;
        }

        .dark .card,
        .dark .table-card {
            background: #111827;
            border-color: #263449;
            box-shadow: 0 2px 8px rgb(0 0 0 / 14%);
        }

        .dark .table-header,
        .dark .table-filters,
        .dark .pagination,
        .dark .pagination-container {
            border-color: #263449;
        }

        .dark th {
            background: #1e293b;
            color: #94a3b8;
            border-color: #334155;
        }

        .dark td {
            color: #cbd5e1;
            border-color: #263449;
        }

        .dark tbody tr:hover,
        .dark .applications-table tbody tr:hover {
            background: #172235;
        }

        .dark .filter-select,
        .dark .filter-input,
        .dark .filter-submit,
        .dark .secondary-button,
        .dark .action-view,
        .dark .action-revoke,
        .dark .action-button {
            background: #172235;
            color: #e2e8f0;
            border-color: #3b4a60;
            color-scheme: dark;
        }

        .dark .filter-input::placeholder {
            color: #64748b;
        }

        .dark .filter-select:hover,
        .dark .filter-input:hover,
        .dark .filter-submit:hover,
        .dark .secondary-button:hover,
        .dark .action-view:hover {
            background: #223149;
            border-color: #52637b;
        }

        .dark .action-revoke,
        .dark .action-button {
            color: #fca5a5;
            border-color: #7f1d1d;
        }

        .dark .action-revoke:hover,
        .dark .action-button:hover {
            background: #3b1822;
            border-color: #b91c1c;
        }

        .dark .user-id,
        .dark .slug,
        .dark .log-method {
            background: #1e293b;
            color: #cbd5e1;
        }

        .dark .date-cell,
        .dark .log-url,
        .dark .log-token {
            color: #cbd5e1;
        }

        .dark .pagination-button {
            background: #172235;
            color: #cbd5e1;
            border-color: #3b4a60;
        }

        .dark .pagination-button:hover {
            background: #223149;
            border-color: #52637b;
        }

        .dark .pagination-button.active {
            background: #0e7490;
            border-color: #0e7490;
            color: #ffffff;
        }

        .dark .pagination-button.disabled {
            background: #111827;
            color: #475569;
            border-color: #263449;
        }

        .dark .status-active,
        .dark .log-status-success {
            background: #064e3b;
            color: #a7f3d0;
        }

        .dark .status-expired,
        .dark .log-status-client-error {
            background: #713f12;
            color: #fde68a;
        }

        .dark .status-revoked,
        .dark .status-inactive,
        .dark .log-status-server-error {
            background: #7f1d1d;
            color: #fecaca;
        }

        .dark .btn-primary {
            background: #0e7490;
        }

        .dark .btn-primary:hover {
            background: #0891b2;
        }

        .dark .btn-danger {
            background: #2b1a23;
            color: #fca5a5;
            border-color: #7f1d1d;
        }

        .dark .btn-danger:hover {
            background: #3b1822;
            border-color: #b91c1c;
        }

        .dark .success-message {
            background: #052e2b;
            border-color: #115e59;
            color: #99f6e4;
        }

        .dark .theme-toggle,
        .dark .logout-button {
            background: #172235;
            border-color: #334155;
            color: #cbd5e1;
        }

        .dark .theme-toggle:hover,
        .dark .logout-button:hover {
            background: #223149;
            border-color: #52637b;
            color: #ffffff;
        }

        .dark .account-chevron {
            color: #94a3b8;
        }

        .dark .account-dropdown {
            background: #111827;
            border-color: #334155;
            box-shadow: 0 12px 28px rgb(0 0 0 / 35%);
        }

        .dark .account-dropdown-email {
            color: #94a3b8;
            border-color: #334155;
        }

        .dark .account-dropdown .logout-button {
            background: transparent;
            border-color: transparent;
            color: #fca5a5;
        }

        .dark .account-dropdown .logout-button:hover {
            background: #3b1822;
            border-color: transparent;
            color: #fecaca;
        }

        .dark .page-heading h1,
        .dark .detail-value {
            color: #f1f5f9;
        }

        .dark .page-heading p,
        .dark .field-hint,
        .dark .credential-intro {
            color: #94a3b8;
        }

        .dark .form-card,
        .dark .detail-card {
            background: #111827;
            border-color: #263449;
            box-shadow: 0 2px 8px rgb(0 0 0 / 14%);
        }

        .dark .form-field label,
        .dark .detail-label {
            color: #cbd5e1;
        }

        .dark .form-control,
        .dark .secret-value {
            background: #172235;
            border-color: #3b4a60;
            color: #e2e8f0;
            color-scheme: dark;
        }

        .dark .form-control[readonly],
        .dark .form-value {
            background: #1e293b;
            border-color: #334155;
            color: #cbd5e1;
        }

        .dark .form-control:focus {
            border-color: #22d3ee;
            box-shadow: 0 0 0 3px rgb(34 211 238 / 14%);
        }

        .dark .form-error-summary {
            background: #3b1822;
            border-color: #7f1d1d;
            color: #fecaca;
        }

        .dark .notice-success {
            background: #052e2b;
            border-color: #115e59;
            color: #99f6e4;
        }

        .dark .notice-warning {
            background: #3b2a12;
            border-color: #854d0e;
            color: #fde68a;
        }

        .dark .button-primary {
            background: #0e7490;
            color: #ffffff;
        }

        .dark .button-primary:hover {
            background: #0891b2;
        }

        .dark .button-secondary {
            background: #172235;
            border-color: #3b4a60;
            color: #cbd5e1;
        }

        .dark .button-secondary:hover {
            background: #223149;
            border-color: #52637b;
            color: #ffffff;
        }

        .dark .app-modal-card {
            background: #111827;
            border-color: #334155;
        }

        .dark .app-modal h2 {
            color: #f1f5f9;
        }

        .dark .app-modal p {
            color: #cbd5e1;
        }

        .dark .app-modal-icon {
            background: #3b2a12;
            color: #fbbf24;
        }

        .dark .app-modal-actions .button-danger {
            border-color: #dc2626;
            background: #dc2626;
            color: #ffffff;
        }

        .dark .app-modal-actions .button-danger:hover {
            border-color: #ef4444;
            background: #b91c1c;
        }

        .dark .copy-feedback {
            color: #6ee7b7;
        }

        @media (max-width: 520px) {
            .dark .user-details {
                max-width: 70px;
            }
        }
    </style>
