<style>
        .board__nav {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 100px;
        }

        .board__nav ul {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F5F5F2;
            border-radius: 50px;
            width: 30%;
            height: 50px;
        }
        .board__search .right {
            position: relative;
        }

        .board__nav li a {
            font-size: 0.8rem;
            margin: 0 25px 0 25px;
        }

        .board__nav:active {
            text-decoration: underline;
        }

        .board__table td {
            padding: 25px 5px;
            border-bottom: 1px solid #b3b3b3;
            text-align: center;
        }

        .board__search .left {
            margin-left: 30px;
            font-size: 0.8rem;
        }

        .btn__style2 {
            width: 100px;
            height: 39px;
            background-color: #285A5B;
            font-size: 0.9rem;
            color: #fff;
            border-radius: 50px;
            cursor: pointer;
        }

        .board__search .right a {
            width: 100px;
            height: 43px;
            color: var(--white);
            font-size: 0.9rem;
            padding: 0.6rem 2rem;
            border-radius: 50px;
        }

        .board__table td {
            padding: 25px 5px;
            border-bottom: 1px solid #b3b3b3;
            text-align: center;
            font-size: 0.9rem;
        }

        .board__table td.active {
            font-weight: 600;
            color: #FFB84D;
        }

        .header__search input {
            width: 80%;
            height: 30px;
            border-radius: 15px;
            background-color: #F2F1EC;
            color: #cfc4c4ab;
            border: none;
            padding-left: 1.2rem;
            position: relative;
            font-size: 0.7rem;
        }
        @media(max-width:1100px){
            .board__nav ul {
                width: 45%;
            }
            .board__search .left {
                display: none;
            }
            .board__search {
                justify-content: flex-end;
            }
        }
        @media(max-width:800px){
            
            
            .board__title {
                margin-top: 15px;
            }
            .board__inner {
                padding: 40px 0;
            }
        }
        @media(max-width:660px){
            .board__nav ul {
                width: 70%;
            }
            .board__search .right select {
                width: 100px;
                display: flex;
            }
            .btn__write {
                position: absolute;
                top: -5px;
                right: 0;
            }
        }
    </style>