<!-- =========================
                 LOGS
            ========================== -->

            <section class="table-card">

                <div class="table-header">

                    <div>

                        <h2>
                            Logs
                        </h2>

                        <span>
                            Registro de accesos a la API
                        </span>

                    </div>

                </div>


                <!-- LOG TABLE -->

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Token
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Usuario
                                </th>

                                <th>
                                    Método
                                </th>

                                <th>
                                    URL
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    IP
                                </th>

                                <th>
                                    Tiempo
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($logs as $log)

                                <tr>

                                    <td>
                                        {{ $log->created_at?->format('d/m/Y H:i:s') }}
                                    </td>

                                    <td class="log-token">
                                        {{ $log->token?->name ?? $log->token_id }}
                                    </td>

                                    <td >
                                        {{ $log->token?->tokenType?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $log->user?->name ?? $log->user_id }}
                                    </td>

                                    <td>

                                        <span class="log-method">
                                            {{ $log->method }}
                                        </span>

                                    </td>

                                    <td>

                                        <div
                                            class="log-url"
                                            title="{{ $log->url }}"
                                        >
                                            {{ $log->url }}
                                        </div>

                                    </td>

                                    <td>

                                        @if($log->status_code >= 500)

                                            <span class="log-status log-status-server-error">
                                                {{ $log->status_code }}
                                            </span>

                                        @elseif($log->status_code >= 400)

                                            <span class="log-status log-status-client-error">
                                                {{ $log->status_code }}
                                            </span>

                                        @else

                                            <span class="log-status log-status-success">
                                                {{ $log->status_code }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $log->ip_address }}
                                    </td>

                                    <td>
                                        {{ $log->response_time_ms }} ms
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="empty"
                                    >
                                        No hay logs registrados.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- LOG PAGINATION -->

                @if($logs && $logs->total() > 0)

                    <div class="pagination">

                        <div class="pagination-info">

                            Mostrando

                            <strong>
                                {{ $logs->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $logs->lastItem() }}
                            </strong>

                            de

                            <strong>
                                {{ $logs->total() }}
                            </strong>

                        </div>

                        <div class="pagination-links">

                            @if($logs->onFirstPage())

                                <span class="pagination-button disabled">
                                    ← Anterior
                                </span>

                            @else

                                <a
                                    href="{{ $logs->previousPageUrl() }}"
                                    class="pagination-button"
                                >
                                    ← Anterior
                                </a>

                            @endif

                            @foreach(
                                $logs->getUrlRange(
                                    1,
                                    $logs->lastPage()
                                ) as $page => $url
                            )

                                @if($page == $logs->currentPage())

                                    <span class="pagination-button active">
                                        {{ $page }}
                                    </span>

                                @else

                                    <a
                                        href="{{ $url }}"
                                        class="pagination-button"
                                    >
                                        {{ $page }}
                                    </a>

                                @endif

                            @endforeach

                            @if($logs->hasMorePages())

                                <a
                                    href="{{ $logs->nextPageUrl() }}"
                                    class="pagination-button"
                                >
                                    Siguiente →
                                </a>

                            @else

                                <span class="pagination-button disabled">
                                    Siguiente →
                                </span>

                            @endif

                        </div>

                    </div>

                @endif

            </section>
