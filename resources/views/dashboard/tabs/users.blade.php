<!-- =========================
                 USERS
            ========================== -->

            <section class="table-card">

                <div class="table-header">

                    <div>

                        <h2>
                            Usuarios
                        </h2>

                        <span>
                            {{ $users->total() }} usuarios
                        </span>

                    </div>

                    <div class="header-actions">

                        <a
                            href="{{ route('users.create') }}"
                            class="primary-button"
                        >
                            + Nuevo usuario
                        </a>

                    </div>

                </div>


                <!-- USER SEARCH -->

                <form
                    method="GET"
                    action="{{ route('dashboard') }}"
                    class="table-filters"
                >

                    <input
                        type="hidden"
                        name="tab"
                        value="users"
                    >

                    <div class="filter-group">

                        <label
                            for="user_search"
                            class="filter-label"
                        >
                            Buscar
                        </label>

                        <input
                            type="text"
                            id="user_search"
                            name="user_search"
                            class="filter-input"
                            placeholder="Nombre o email..."
                            value="{{ $userSearch }}"
                        >

                    </div>

                    <button
                        type="submit"
                        class="filter-submit"
                    >
                        Buscar
                    </button>

                </form>


                <!-- USER TABLE -->

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Nombre
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Tokens
                                </th>

                                <th>
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                                <tr>

                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

                                    <td>
                                        {{ $user->tokens_count }}
                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('users.show', $user->id) }}"
                                            class="secondary-button"
                                        >
                                            Ver
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty"
                                    >
                                        No hay usuarios registrados.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- USER PAGINATION -->

                @if($users->total() > 0)

                    <div class="pagination">

                        <div class="pagination-info">

                            Mostrando

                            <strong>
                                {{ $users->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $users->lastItem() }}
                            </strong>

                            de

                            <strong>
                                {{ $users->total() }}
                            </strong>

                        </div>

                        <div class="pagination-links">

                            @if($users->onFirstPage())

                                <span class="pagination-button disabled">
                                    ← Anterior
                                </span>

                            @else

                                <a
                                    href="{{ $users->previousPageUrl() }}"
                                    class="pagination-button"
                                >
                                    ← Anterior
                                </a>

                            @endif

                            @foreach(
                                $users->getUrlRange(
                                    1,
                                    $users->lastPage()
                                ) as $page => $url
                            )

                                @if($page == $users->currentPage())

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

                            @if($users->hasMorePages())

                                <a
                                    href="{{ $users->nextPageUrl() }}"
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
