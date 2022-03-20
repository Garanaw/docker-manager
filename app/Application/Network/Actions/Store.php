<?php

declare(strict_types=1);

namespace Application\Network\Actions;

use Application\Network\Requests\StoreRequest;
use Domain\Network\Services\NetworkWriter as Writer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class Store
{
    public function __invoke(
        Redirector $redirect,
        StoreRequest $request,
        Writer $writer
    ): RedirectResponse {
        try {
            $network = $writer->create($request->toDto());
        } catch (\Exception $e) {
            return $redirect->back()->withInput()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }

        return $redirect->route('network.show', [
            'network' => $network->getId(),
        ]);
    }
}
