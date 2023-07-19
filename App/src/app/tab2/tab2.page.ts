import { Component, OnInit } from '@angular/core';
import { CardsService } from '../services/cards.service';
import { HorariosService } from '../services/horarios.service';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page implements OnInit {


  constructor(
    private CardsService: CardsService,
    private HorariosService: HorariosService
  ) { }

  public cards: any;
  public horarios: any;
  public isModalOpen: boolean = false;
  public horarioDiasUteis: any[] = [];
  public horarioSabado: any[] = [];
  public horarioDomingoFeriados: any[] = [];
  public linha: string;
  public cidadeIda: string;
  public cidadeVolta: string;

  listarCards() {
    this.CardsService.cards().subscribe(
      (response) => {
        this.cards = response;
        this.cards.forEach(card => {
          card.linha = Number(card.linha)
        });
      },
      (error) => {
        console.log("ERRO: " + error.error)
      }
    );
  }

  async abrirHorarios(linha: number) {
    const dados = {
      id: linha
    };
    await this.HorariosService.consultarHorarios(dados).subscribe(
      response => {
        this.horarioDiasUteis = [];
        this.horarioSabado = [];
        this.horarioDomingoFeriados = [];
        response.forEach(horario => {
          horario.diaSemanal == 'DIAS UTEIS' ? this.horarioDiasUteis.push(horario) : (horario.diaSemanal == 'SÁBADOS' ? this.horarioSabado.push(horario) : this.horarioDomingoFeriados.push(horario));
          this.linha = response[0].linha;
          this.cidadeIda = response[0].cidadeIda;
          this.cidadeVolta = response[0].cidadeVolta;
          this.isModalOpen = true;
        });
      },
      error => {
        console.error('Erro ao enviar dados', error.error);
      }
    );
  }

  ngOnInit(): void {
    this.listarCards();
  }

}
