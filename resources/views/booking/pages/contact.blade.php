@extends('booking.layout.master-layout')

@section('content')
    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-text">
                        <h2>Thông tin liên hệ</h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="c-o">Địa chỉ:</td>
                                    <td>{{$contact->address}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Số điện thoại:</td>
                                    <td>{{$contact->phone}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Email:</td>
                                    <td>{{$contact->email}}</td>
                                </tr>
                                <tr>
                                    <td class="c-o">Mã số thuế:</td>
                                    <td>{{$contact->masothue}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8608087413927!2d105.79189341493274!3d21.038254685993156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3829364ab7%3A0x3034d069a38bef5b!2zVOG7lSBo4bujcCBuaMOgIMSRYSBuxINuZywgNzIgVHLhuqduIMSQxINuZyBOaW5oLCBE4buLY2ggVuG7jW5nLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaQ!5e0!3m2!1sfr!2s!4v1594290606606!5m2!1sfr!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection