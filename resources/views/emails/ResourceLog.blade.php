<p style="color: red">Warning</p>
<p>Your server has the following problems:</p>
@isset($resourceLogs['cpu'])
    <p>cpu usage: {{ $resourceLogs['cpu'] }}</p>
@endisset
@isset($resourceLogs['memory'])
    <p>memory usage: {{ $resourceLogs['memory'] }}</p>
@endisset
@isset($resourceLogs['network'])
    <p>network connection status: {{ $resourceLogs['network'] }}</p>
@endisset
@isset($resourceLogs['hardDisk'])
    <p>hard disk usage:  {{ $resourceLogs['hardDisk'] }}</p>
@endisset
@isset($resourceLogs['webServer'])
    <p>web server status  {{ $resourceLogs['webServer'] }}</p>
@endisset
