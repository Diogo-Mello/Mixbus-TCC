import { TestBed } from '@angular/core/testing';

import { LocalizacaoOnibusService } from './localizacao-onibus.service';

describe('LocalizacaoOnibusService', () => {
  let service: LocalizacaoOnibusService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(LocalizacaoOnibusService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
