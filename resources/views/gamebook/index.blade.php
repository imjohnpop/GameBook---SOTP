@extends('gamebook.wrapper')
@section('content')
    <nav id="nav" class="navbar navbar-expand-lg navbar-dark">
        <ul class="navbar-nav">
            <li class="dropdown bg-light rounded p-3 border border-dark ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
<main>
    <section id="logo">
        <img src="img/logo.png" alt="logo">
    </section>


    <section id="headline">
        <h1>Secrets of The Pyramids</h1>
    </section>

    <section id="chapterHeadline">
        <h2>Chapter
            <?= $data[0]->chapter_id;?></h2>
    </section>

    <section id="bg">
    </section>

    <img id="image" src="img/<?=$data[0]->chapter_pic;?>" style="display: <?php if (!isset($data[0]->chapter_pic)){echo 'none';}?>;">

    <section id="main">
        <div id="text">
            <?= $data[0]->chapter_text;?>
        </div>
        <div id="choices">
            <?php foreach ($data as $value) :?>
            <form action="" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="<?= $value->chapter_next;?>">
                <input class="button" type="submit" value="<?= $value->chapter_options;?>">
            </form>
            <?php endforeach; ?>
        </div>
    </section>

</main>
@stop