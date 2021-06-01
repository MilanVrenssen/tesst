<!DOCTYPE html>
<html lang='nl' xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset='UTF-8'>
    <title>2010 temperaturen</title>
    <style>
        *{

            font-family: "Comic Sans MS", sans-serif;
            font-size: 25px}
        table{
            border: 1px solid black;
        }
        td{text-align: right}
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<form action="overzicht" method="get">
    Maand: <select name="maand" onchange="submit()" >
        @for ($i = 0; $i <= 12; $i++)
        <option value="{{$i}}" @if($i == $maand) selected @endif>{{$maandnamen[$i]}}</option>
        @endfor
    </select>

    <div class="meting">
        <input type="radio" id="Celsius" name="Temperature" value="C" @if ($Temperature == 'C') checked @endif onclick="submit()">
        <label for="C">Celsius</label>
        <input type="radio" id="Farenheit" name="Temperature" value="F" @if ($Temperature == 'F') checked @endif onclick="submit()">
        <label for="F">Farenheit</label>
        <input type="radio" id="Kelvin" name="Temperature" value="K" @if ($Temperature == 'K') checked @endif onclick="submit()">
        <label for="K">Kelvin</label>
        <input type="radio" id="Rankine" name="Temperature" value="R" @if ($Temperature == 'R') checked @endif onclick="submit()">
        <label for="Rankine">Rankine</label>
        <input type="radio" id="Réaumur" name="Temperature" value="Ré" @if ($Temperature == 'Ré') checked @endif onclick="submit()">
        <label for="Réaumur">Réaumur</label>
    </div>

</form>
<form action="nieuwsbrief" method="post" novalidate>
@csrf
    <label>E-mailadres:</label>
    <input type="email" required name="emailadres"/>
    <button type="submit">Vraag nieuwsbrief aan</button>
</form>
<?php $maandnamen=array("Selecteer maand","Januari","Februari","Maart","April","Mei","Juni",
    "Juli","Augustus","September","Oktober","November","December");?>
<h1>{{$maandnamen[$maand]}}</h1>

<table >
    <tr><th>Dag</th><th>Minimum</th><th>Maximum</th></tr>
    @foreach($metingen as $m)
    <tr>
        <td> {{$m->dagnr}} </td>
        <td> {{Number_format($m->minimum,1)}} @if ($Temperature != "K") <?php echo "&deg;" ?> @endif {{$Temperature}} </td>
        <td> {{Number_format($m->maximum,1)}} @if ($Temperature != "K") <?php echo "&deg;" ?> @endif {{$Temperature}} </td>
    </tr>



    @endforeach
</table>
</body>
</html>
