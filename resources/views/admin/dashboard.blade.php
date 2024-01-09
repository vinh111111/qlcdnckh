@extends('admin.layout.master')
@section('css')
@endsection
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Table
                    </h3>
                    <a href="#"><i class="fa fa-plus"></i></a>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th>Due date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>React</td>
                                <td>Tran Anh Tuat</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-success"></i>
                                        Completed
                                    </span>
                                </td>
                                <td>17/07/2020</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Vue</td>
                                <td>Bui Nhu Sang</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-warning"></i>
                                        In progress
                                    </span>
                                </td>
                                <td>18/07/2020</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Laravel</td>
                                <td>Phan Nhat Truong</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-warning"></i>
                                        In progress
                                    </span>
                                </td>
                                <td>17/07/2020</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Django</td>
                                <td>Le Anh Tuan</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-danger"></i>
                                        Delayed
                                    </span>
                                </td>
                                <td>07/07/2020</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>MEAN</td>
                                <td>John Evan</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-primary"></i>
                                        Pending
                                    </span>
                                </td>
                                <td>20/08/2020</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>MERN</td>
                                <td>Robert</td>
                                <td>
                                    <span class="dot">
                                        <i class="bg-primary"></i>
                                        Pending
                                    </span>
                                </td>
                                <td>20/08/2020</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection