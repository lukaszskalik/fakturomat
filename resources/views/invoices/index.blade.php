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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Lista Faktur</h2>
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
                        <th scope="col">Numer Faktury</th>
                        <th scope="col">Kwota</th>
                        <th scope="col">Klient</th>
                        <th scope="col">Data</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <tbody>
                        @foreach ($list as $invoice)
                        <tr>
                            <th scope="row">{{$invoice->id}}</th>
                            <td>{{$invoice->number}}</td>
                            <td>{{$invoice->total}}</td>
                            <td>{{$invoice->customer->name}}</td>
                            <td>{{$invoice->date}}</td>
                            <td>
                                @if (count($invoice->attachments) > 0)
                                    <a href="{{ Storage::url($invoice->attachments[0]->path) }}" class="btn btn-warning">Załącznik</a>
                                @endif
                            </td>
                            <td><a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}" class="btn btn-success">Edytuj</a></td>
                            <td><a href="{{ route('invoices.export', ['id' => $invoice->id]) }}" class="btn btn-info">Pdf</a></td>
                            <td>
                              <form method="POST" action="{{ route('invoices.delete', ['id' => $invoice->id]) }}">
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
