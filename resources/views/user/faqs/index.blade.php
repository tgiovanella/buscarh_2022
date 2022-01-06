@extends('user.layouts.page')

@section('content')
<div class="row">
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>FAQs</h2>
        <div class="accordion" id="faqExample">
            @forelse ($faqs as $faq)
            <div class="card">
            <div class="card-header p-2" id="heading{{ $faq->slug }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button"
                        data-toggle="collapse"
                        data-target="#collapse{{ $faq->slug }}"
                        aria-expanded="true"
                        aria-controls="collapse{{ $faq->slug }}">
                            Q: {{ $faq->question }}
                        </button>
                        </h5>
                </div>

                <div id="collapse{{ $faq->slug }}" class="collapse" aria-labelledby="heading{{ $faq->slug }}" data-parent="#faqExample">
                    <div class="card-body">
                        <b>Resposta:</b> {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @empty

                @alert(['type'=>'warning'])
                Não existem FAQ cadastrados
                @endalert
            @endforelse


        </div>



    </div>
</div>
@endsection

@push('styles')

@endpush
