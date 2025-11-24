@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <style>
        .dashboard {
            display: flex;
            gap: 50px;
            flex: 1;
            width: 100%;

        }

        .dashboard__main {
            flex: 4;

            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        .dashboard__kpi {
            flex: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .tarjet-kpi {
            background-color: #CCD8E3;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            width: 100%;
        }

        .welcome-card{
            border-radius: 20px;
            position: relative;
            background-image: url("/img/bg-welcome.svg");
            background-size: cover;
            background-repeat: no-repeat;
            padding: 25px 40px;
            height: 380px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 25px;
        }

        .welcome-card__content{
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            color: #FFF;
        }

        .welcome-card__title{
            font-size: 18px;
            font-weight: 700;
        }

        .welcome-card__text{
            font-size: 13px;
            font-weight: 300;
        }


        .welcome-card__button{
            background-color: #FFAF00;
            border: 1px solid #FFAF00;
            border-radius: 10px;
            color: #FFF;
            font-size: 13px;
            font-weight: 500;
            padding: 10px 20px;
            cursor: pointer;
        }

        .recent-movements{
            width: 100%;
            height: 100%;
        }

        .recent-movements__header{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .recent-movements__title{
            color: #222324;
            font-size: 18px;
        }

        .recent-movements__link-button{
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            color: #FFF;
            font-weight: 400;
            border-radius: 10px;
            background-color: #1A5D94;
            border: none;
            font-size: 12px;
            cursor: pointer;
        }

        .recent-movements__icon{
            height: 18px;
            width: 18px;
        }

        .material-symbols-outlined{
            font-size: 18px !important;
        }

        .recent-movements__table-container{
            width: 100%;
            height: 100%;
            background-image: url('/img/build-page.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .recent-movements__table-container img{
            width: auto;
            height: 50%;
        }
    </style>

    <div class="dashboard">

        <div class="dashboard__main">

            <section class="welcome-card">
                <div class="welcome-card__content">
                    <h2 class="welcome-card__title">Bienvenido {{ auth()->user()->name }}!</h2>
                    <p class="welcome-card__text">
                        Gestiona la información académica de forma rápida y segura desde este panel diseñado para agilizar
                        tus tareas diarias.
                    </p>
                </div>

                <div class="welcome-card__action">
                    <form action="{{ route('matriculas.index') }}" method="get">
                        <button type="submit" class="welcome-card__button">
                            Registrar Matrículas
                        </button>
                    </form>
                </div>
            </section>

            <section class="recent-movements">

                <header class="recent-movements__header">
                    <h3 class="recent-movements__title">
                        Últimos movimientos - Matrículas
                    </h3>

                    <form action="{{ route('matriculas.index') }}" method="get" class="recent-movements__form">
                        <button type="submit" class="recent-movements__link-button">
                            Ver Todos
                            <span class="material-symbols-outlined recent-movements__icon">arrow_forward</span>
                        </button>
                    </form>
                </header>

                <div class="recent-movements__table-container">
                </div>

            </section>
        </div>

        <aside class="dashboard__kpi">
            <div class="tarjet-kpi"></div>
            <div class="tarjet-kpi"></div>
            <div class="tarjet-kpi"></div>
            <div class="tarjet-kpi"></div>
            <div class="tarjet-kpi"></div>
        </aside>

    </div>

@endsection

@push('scripts')
    <!-- <script src="{{ asset('js/cursos.js') }}"></script>
                <script src="{{ asset('js/buscador.js') }}"></script> -->
@endpush