@extends('layouts.app')

@section('content')

        <!-- Portfolio Section-->
        <section class="masthead page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Alert successful add invoice -->
                @if (session()->has('messege'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('messege')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Lista Użytkowników</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Data dołączenia</th>
                        <th scope="col">Aktywny?</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach (\App\Models\User::all() as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->is_banned ? 'NIE' : 'TAK'}}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.change', ['user_id' => $user->id]) }}">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-danger">Zmień dostęp</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('users.export') }}" class="btn btn-success">Eksportuj</a>
            </div>
        </section>
@endsection
