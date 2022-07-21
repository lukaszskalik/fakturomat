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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Lista Klientów</h2>
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
                        <th scope="col">Adres</th>
                        <th scope="col">NIP</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <th scope="row">{{$customer->id}}</th>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->nip}}</td>
                            <td><a href="{{ route('customers.edit', ['klienci' => $customer->id]) }}" class="btn btn-success">Edytuj</a></td>
                            <td>
                              <form method="POST" action="{{ route('customers.destroy', ['klienci' => $customer->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">usuń</button>
                              </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                  </table>
            </div>
        </section>
@endsection
