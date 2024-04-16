<div style="font-size: 14px">
    <b style="color: red">Whoops!! &#128128;</b>
    <p>Your server has the following problems:</p>
    @isset($resourceLogs['cpu'])
        <p>Cpu usage: {{ $resourceLogs['cpu'] }} %</p>
    @endisset
    @isset($resourceLogs['memory'])
        <p>Memory usage: {{ $resourceLogs['memory'] }} %</p>
    @endisset
    @isset($resourceLogs['network'])
        <p>Network connection status: {{ $resourceLogs['network'] }}</p>
    @endisset
    @isset($resourceLogs['storage'])
        <p>Remaining free space on the Storage: {{ $resourceLogs['storage'] }} GB</p>
    @endisset
    @isset($resourceLogs['webServer'])
        <p>Web server status: {{ $resourceLogs['webServer'] }}</p>
    @endisset
</div>