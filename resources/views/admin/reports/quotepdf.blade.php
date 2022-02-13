<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        footer .page:after {
            content: counter(page, decimal);
        }

        body {
            margin-top: 2.3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.70em;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 1cm;
            height: 2cm;
            text-align: center;
            line-height: 0.5cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            line-height: 0.5cm;
            white-space: pre-line;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: black;
        }

        td.bg-gray {
            background: #D3D3D3
        }

        div.pr {
            padding: 0 0 0 8px;
        }

        div {
            padding: 4px 0 0 0;
        }

        td {
            text-align: left;
        }

        table tbody tr {
            margin-bottom: 2px;
        }

        table thead tr th {
            text-align: left;
            font-size: 14px;
            background: #272C33;
            color: #ffff;
        }

        tr:nth-child(even) {
            background: #f0f0f0;
        }

        .text-r {
            text-align: right;
        }
        .text-l {
            text-align: left;
        }

        .text-c {
            text-align: center;
        }

        .red {
            color: tomato;
            font-weight: 750;
        }

        .blue {
            color: #03a9f4;
            font-weight: 750;
        }
    </style>
</head>

<body>

    <script type="text/php">

        if ( isset($pdf) ) {
            $size = 6;
            $color = array(0,0,0);
            if (class_exists('Font_Metrics')) {
                $font = Font_Metrics::get_font("helvetica");
                $text_height = Font_Metrics::get_font_height($font, $size);
                $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
            } elseif (class_exists('Dompdf\\FontMetrics')) {
                $font = $fontMetrics->getFont("helvetica");
                $text_height = $fontMetrics->getFontHeight($font, $size);
                $width = $fontMetrics->getTextWidth("Page 1 of 2", $font, $size);
            }

            $foot = $pdf->open_object();
            
            $w = $pdf->get_width();
            $h = $pdf->get_height();

            // Draw a line along the bottom
            $y = $h - $text_height - 24;
            $pdf->line(16, $y, $w - 16, $y, $color, 0.5);

            $pdf->close_object();
            $pdf->add_object($foot, "all");

            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

            // Center the text
            $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
  
    }
</script>
<header>
    <div style="width: 100%;content-align:center;">
        <div style="white-space: pre-line;vertical-align: middle;text-align:center">
            <h2>Relatório de Cotações</h2>
            Periodo: {{ date('d/m/Y', strtotime($inicio)) }} - {{ date('d/m/Y', strtotime($fim)) }}
            Filtro: {{$status}}
        </div>
    </div>
</header>
    <main>

        <table id="table_search" class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titulo da Cotação</th>
                    <th>Empresa Tomadora</th>
                    <th>Data</th>
                    <th>Categorias</th>
                    <th>Cidades</th>
                    <th>Descrição Cotação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $q)
                <tr>
                    <td>{{$q->id}}</td>
                    <td>{{$q->title}}</td>
                    <td>{{$q->company->name}}</td>
                    <td>{{ date('d/m/Y',strtotime($q->created_at))}}</td>
                    <td>{{implode(', ',$q->subcategories->pluck('name')->toArray())}}</td>
                    <td>{{implode(', ',$q->cities->pluck('title')->toArray())}}</td>
                    <td style="font-size:10px">{{$q->description}}</td>
                </tr>
                <tr>
                    <td colspan="7">
                        <table style="width:100%;background: #f0f0f0;">
                            <tr>
                                <th></th>
                                <th class="text-l">Candidatos</th>
                                <th class="text-l">Valor Proposta</th>
                            </tr>
                            @foreach($q->candidates as $c)
                            <tr>
                                <td> {{$q->id}} </td>
                                <td> {{$c->company->name}}</td>
                                <td> {{number_format($c->price,2,',','.')}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>

</html>