<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1>WelCome!</h1>
    <div class="table-responsive">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Url</th>
                  <th scope="col">Request Type</th>
                  <th scope="col">Total</th>
                  <th scope="col">Created at</th>
                  <th scope="col">Updated at</th>
                </tr>
            </thead>
            @forelse( $contents??[] as $date => $urls)
                @foreach ( $urls as $url => $data )
                    <tr>
                        <th scope="row"></th>
                        <th >{{ $url }}</th>
                        <td>{{ $data->count }}</td>
                        <td>{{ $data->request_type }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->updated_at }}</td>
                    </tr>
                @endforeach
            @empty
            <tr>
                <td colspan="6"> No Data Available</td>
            </tr>
            @endforelse
                
            
           
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>