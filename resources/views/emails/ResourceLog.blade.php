<div style="font-size: 14px">
    <b style="color: red">Whoops!! &#128128;</b>
    @if ($logs['stethoscope:health'])
        <p>We Are Up!</p>
    @endif
    @if ($logs['stethoscope:monitor'])
        <p>The server is at risk</p>
    @endif
    @isset($logs['cpu'])
        <p>Cpu usage: {{ $logs['cpu'] }} %</p>
    @endisset
    @isset($logs['memory'])
        <p>Memory usage: {{ $logs['memory'] }} %</p>
    @endisset
    @isset($logs['network'])
        <p>Network connection status: {{ $logs['network'] }}</p>
    @endisset
    @isset($logs['storage'])
        <p>Remaining free space on the Storage: {{ $logs['storage'] }} GB</p>
    @endisset
    @isset($logs['webServer'])
        <p>Web server status: {{ $logs['webServer'] }}</p>
    @endisset
</div>