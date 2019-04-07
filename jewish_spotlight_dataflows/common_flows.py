from dataflows import Flow, dump_to_path, printer, checkpoint


def dump_print_flow(flow, dump_path, checkpoint_name=None, **kwargs):
    return Flow(
        flow,
        checkpoint(checkpoint_name) if checkpoint_name else None,
        dump_to_path(dump_path),
        printer(**kwargs)
    )


def run_dump_print(flow, dump_path, **kwargs):
    dump_print_flow(flow, dump_path, **kwargs).process()
