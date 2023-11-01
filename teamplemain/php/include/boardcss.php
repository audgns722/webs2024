<style>
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
            
        }
        @media(max-width:800px){
            .board__title {
                margin-top: 15px;
            }
            .board__inner {
                padding: 40px 0;
            }
            .board__nav ul {
                width: 50%;
            }
            .board__search {
                justify-content: flex-end;
            }
            .board__search .left > p {
                display: none;
            }
            .board__table .table__col2 {
                width: 30%;
            }
        }
        @media(max-width:660px){
            .board__nav ul {
                width: 300px;
            }
            .board__search .right input {
                /* width: 50%; */
            }
        }
    </style>