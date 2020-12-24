@extends('layouts.backend')

@section('css_after')
<!-- helpful articles about building a trello interface:
    article: https://uxdesign.cc/creating-horizontal-scrolling-containers-the-right-way-css-grid-c256f64fc585
    article: https://www.sitepoint.com/building-trello-layout-css-grid-flexbox/
    article: https://codeburst.io/how-to-create-horizontal-scrolling-containers-d8069651e9c6
-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>

        .ui {
            margin: 0;
            font-family: 'Roboto';
            font-size: 14px;
            line-height: 1.3em;

            /* height: 100vh; */
            height: 100%;
            display: grid;
            grid-template-rows: 40px 50px 1fr;
            background-color: #0079bf;
            color: #eee;
        }

        .navbar {
            padding-left: 10px;
            display: flex;
            align-items: center;
        }
        .navbar.app {
            background-color: #0067a3;
            font-size: 1.5rem;
        }
        .navbar.board {
            font-size: 1.1rem;
        }

        .lists {
            display: flex;
            overflow-x: auto;
        }
        .lists > * {
            flex: 0 0 auto;
            margin-left: 10px;
        }
        .lists::after {
            content: '';
            flex: 0 0 10px;
        }

        .list {
            width: 300px;
            height: calc(100% - 10px - 17px);
        }
        .list > * {
            background-color: #e2e4e6;
            color: #333;
            padding: 0 10px;
        }
        .list header {
            line-height: 36px;
            font-size: 16px;
            font-weight: bold;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .list footer {
            line-height: 36px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            color: #888;
        }
        .list ul {
            list-style: none;
            margin: 0;
            max-height: calc(100% - 36px - 36px);
            overflow-y: auto;
        }
        .list ul li {
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }
        .list ul li:not(:last-child) {
            margin-bottom: 10px;
        }
        .list ul li img {
            display: block;
            width: calc(100% + 2 * 10px);
            margin: -10px 0 10px -10px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .block-header:hover .block-options {
            display: block;
        }

        .block-header .block-options {
            display: none;
        }


    </style>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Groepen met studenten <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Subtitle</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">groepen met studenten</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="ui">
        <nav class="navbar app">App bar</nav>
        <nav class="navbar board">Board bar</nav>
        <div class="lists">

            @foreach($groups as $group)
            <div class="list">
                <header>{{ $group->schedule_code }}</header>
                <ul>
                    @foreach($group->students as $student)
                    <div class="block block-rounded block-mode-hidden" style="margin-bottom:10px; padding: 0px;" >
                        <div class="block-header" style="padding: 5px 10px">
                            <h3 class="block-title">{{ $student->voornaam }} <small>{{ $student->tussenvoegsel }} {{ $student->achternaam }}</small></h3>
                            <div class="block-options">
                            <!--
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action=""><i class="fa fa-fw fa-comment mr-1"></i></button>
                            -->
                                <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-block-popout"><i class="fa fa-fw fa-comment mr-1"></i></button>

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>

                    </div>
                    <!--
                        <li>{{ $student->voornaam }} {{ $student->tussenvoegsel }} {{ $student->achternaam }}</li>
                    -->
                    @endforeach
                </ul>
                <footer>Add a card...</footer>
            </div>
            @endforeach


        </div>
    </div>
    <!-- END Page Content -->


    <!-- Pop Out Block Modal -->
    <div class="modal fade" id="modal-block-popout" tabindex="-1" role="dialog" aria-labelledby="modal-block-popout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Opmerking</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf

                        <div class="block-content font-size-sm">

                        <div class="form-group">
                            <label for="comment">Opmerking</label>
                            <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="..."></textarea>
                        </div>

                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" name="close" id="close" class="btn btn-sm btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" value="submit" name="submit" id="submit" class="btn btn-sm btn-primary"><i class="fa fa-check mr-1"></i>Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Pop Out Block Modal -->


@endsection
